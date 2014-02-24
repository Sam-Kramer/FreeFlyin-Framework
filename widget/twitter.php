<?php
class TwitterWidget extends Widget {

	private $tweets = array();

	protected function beforeLoad() {
            parent::beforeLoad();
            $mysql = PublicRegistry::dispatch('MysqlStub');
            $result = $mysql->fetchArray('SELECT * FROM tweets');

            if((time() - $result[0]['time']) > $this->args['update_time']) {
		    $this->updateTwitterFeed();
            } else {
                  foreach($result as $tweet)
                        $this->tweets[] = $tweet['text'];          
            }
	}

    public function onLoad() {
        $this->loadView('twitter', array('tweets' => $this->tweets, 'username' => $this->args['username']));
    }

      private function updateTwitterFeed() {
            $ch = curl_init('http://twitter.com/statuses/user_timeline/'.$this->args['username'].'.json?count='.$this->args['count']);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $results = curl_exec($ch);
            curl_close($ch);  
            
            $results = json_decode($results);

            foreach($results as $result) {
                  $this->tweets[] = $result->text;
            } 

            $mysql = PublicRegistry::dispatch('MysqlStub');
            $result = $mysql->query('SELECT * FROM tweets');
            $time = time();
            $id = 0;

            if(mysql_num_rows($result) < $this->args['count']) {
                  if(count($this->tweets) >= $this->args['count']) {
                        mysql_free_result($result);
                        foreach($this->tweets as $tweet) {
                              $tweet = mysql_real_escape_string($tweet);
                              $mysql->query("INSERT INTO tweets (text,time) VALUES ('$tweet', '$time')");
                        }      
                  }
            } else {
                  mysql_free_result($result); 
                  foreach($this->tweets as $tweet) {
                        $id++;
                        $tweet = mysql_real_escape_string($tweet);
                        $mysql->query("UPDATE tweets SET text='$tweet', time='$time' WHERE id='$id'");
                  } 
            }                      
      }
}
?>