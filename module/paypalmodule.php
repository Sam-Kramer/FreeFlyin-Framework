<?php
class PaypalModule extends Module {

    private $business_email, $mysql, $notify_url, $return, $cancel_return, $currency_code = 'USD', $lc = 'US', $rm = '2',
                $shipping = '0';
    protected $args = array();

    public function __construct($args) {
        $this->args = $args;
        $this->business_email = $this->args['business_email'];
        $this->notify_url = $this->args['notify_url'];
        $this->return = array_key_exists('return', $this->args) ? $this->args['return'] : URL;
        $this->cancel_return = array_key_exists('cancel', $this->args) ? $this->args['cancel'] : URL;;
        $this->mysql = PublicRegistry::dispatch('MysqlStub');
    }

    public function setCurrencyCode($currency) {
        $this->currency_code = $currency;
    }

    public function setlc($lc) {
        $this->lc = $lc;
    }

    public function setrm($rm) {
        $this->rm = $rm;
    }

    public function setShipping($shipping) {
        $this->shipping = $shipping;
    }

    public function getButton() {
        if(!empty($_SESSION['cart'])) {
        ?>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="<?php echo $this->business_email; ?>">
        <?php
        foreach($this->args['items'] as $item) {
            ?>
        <input type="hidden" name="item_name_<?php echo $item['id']; ?>" value="<?php echo $item['title']; ?>">
        <input type="hidden" name="item_number_<?php echo $item['id']; ?>" value="<?php echo $item['id']; ?>">
        <input type="hidden" name="amount_<?php echo $item['id']; ?>" value="<?php echo $item['price']; ?>">
        <input type="hidden" name="quantity_<?php echo $item['id']; ?>" value="1">
    <?php
        }

        ?>
        <input type="hidden" name="currency_code" value="<?php echo $this->currency_code; ?>">
        <input type="hidden" name="lc" value="<?php echo $this->lc; ?>">
        <input type="hidden" name="rm" value="<?php echo $this->rm; ?>">
        <input type="hidden" name="shipping_1" value="<?php echo $this->shipping; ?>">
        <input type="hidden" name="return" value="<?php echo $this->return; ?>">
        <input type="hidden" name="cancel_return" value="<?php echo $this->cancel_return; ?>">
        <input type="hidden" name="notify_url" value="<?php echo $this->notify_url; ?>">
        <input type="submit" name="pay now" value=" " class="paypal-button" />
        <?php
        }
    }
}

?>
