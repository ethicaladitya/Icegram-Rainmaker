<?php 
 if( get_option('rm_offer_halloween_done_2018_icegram') == 1 ) return;
?>
<style type="text/css">
.ig_offer{
    width: 70%;
    height: auto;
    margin: 1em auto;
    text-align: center;
    background-color: #f18322;
    font-size: 1.2em;
    letter-spacing: 3px;
    line-height: 1em;
    padding: 1.2em;
    background-image: url('<?php echo  $this->plugin_url ?>../assets/images/happy-hallowen.png');
    background-repeat: no-repeat;
    background-size: 40%;
    background-position: left;
}
.ig_offer_heading{
    color: #64badd;
    color: #FFF;
    padding: 1em 0;
    line-height: 1em;
}
.ig_main_heading {
    font-size: 5em;
    color: #b70f0f;
    font-weight: 600;
    line-height: 1.2em;
    position: relative;
}

.ig_text{
    font-size: 0.9em;
}
.ig_left_text{
    padding: 0.5em 0em;
    color: #000;
}
.ig_right_text{
    color: #FFFFFF;
    font-weight: 600;
    max-width: 50%;
    padding: 10px 56px;
    width: auto;
    margin: 0.9em 0em;
    display: inline-block;
    text-decoration: none;
    background: #b70f0f;
}
.ig_right_text:hover, .ig_right_text:active{
    color: inherit; 
}
.ig_offer_content{
    margin-left: 35%;
}
</style>
<div class="ig_offer">
    <div style="float:right;"><img src="<?php echo  $this->plugin_url ?>../assets/images/rainmaker-logo-40.png"  /></div>
    <div  class="ig_offer_content">
        <div class="ig_offer_heading">&mdash; Halloween Sale &mdash;</div>
        <div class="ig_main_heading">Upto 50% OFF</div>
        <div class="ig_text">
            <div class="ig_left_text" style="font-size:1.1em;">Offer applicable on</div>
            <div class="ig_left_text" style="font-size:1.1em;"> <span style="color:#FFF;font-weight:bold">Icegram, Rainmaker & Email Subscribers</span></div>
            <a href="?rm_dismiss_admin_notice=1&rm_option_name=rm_offer_halloween_done_2018" target="_blank" class="ig_right_text">Claim This Offer</a>
            <div class="ig_left_text">Offer ends on 2nd November, 2018 - so hurry.. </div>
        </div>
    </div>
</div>