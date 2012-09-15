<?php
/*

Cakephp 2.x User Management Premium Version
Copyright (c) 2012 EktaSoftwares
Website- http://EktaSoftwares.com/
Demo- http://umpremium.ektasoftwares.com/

UMPremium is a copyrighted work of authorship. EktaSoftwares
retains ownership of the product and any copies of it, regardless of the
form in which the copies may exist. This license is not a sale of the
original product or any copies.

By installing and using UMPremium on your server, you agree to the following
terms and conditions. Such agreement is either on your own behalf or on behalf
of any corporate entity which employs you or which you represent
('Corporate Licensee'). In this Agreement, 'you' includes both the reader
and any Corporate Licensee and EktaSoftwares.Com

The Product is licensed only to you. You may not rent, lease, sublicense, sell,
assign, pledge, transfer or otherwise dispose of the Product in any form, on
a temporary or permanent basis, without the prior written consent of EktaSoftwares.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, EktaSoftwares reserves the right
to action against you.

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN
THE PRODUCT.

*/
?>
<?php if(USE_FB_LOGIN || USE_TWT_LOGIN || USE_GMAIL_LOGIN || USE_YAHOO_LOGIN || USE_LDN_LOGIN || USE_FS_LOGIN) { ?>
<div class="providerBox">
	<div class="sign_with"><?php echo __('Sign in using your account with'); ?></div>
	<ul class="providers">
		<?php if(USE_FB_LOGIN){ ?>
		<li id="facebook" class="" title='Facebook Connect' onclick="javascript:login_popup('fb');return false;"></li>
		<?php } if(USE_TWT_LOGIN){ ?>
		<li id="twitter" class="" title='Twitter Connect' onclick="javascript:login_popup('twt');return false;"></li>
		<?php } if(USE_GMAIL_LOGIN){ ?>
		<li id="google" class="" title='Gmail Connect' onclick="javascript:login_popup('gmail');return false;"></li>
		<?php } if(USE_YAHOO_LOGIN){ ?>
		<li id="yahoo" class="" title='Yahoo Connect' onclick="javascript:login_popup('yahoo');return false;"></li>
		<?php } if(USE_LDN_LOGIN){ ?>
		<li id="linkedin" class="" title='Linkedin Connect' onclick="javascript:login_popup('ldn');return false;">
		<?php echo $this->Html->image('linked-js-signin.png', array('alt' => 'linked in'))?>
		</li>
		<?php } if(USE_FS_LOGIN){ ?>
		<li id="foursquare" class="" title='Foursquare Connect' onclick="javascript:login_popup('fs');return false;"></li>
		<?php } ?>
		<div style="clear:both"></div>
	</ul>
</div>
<?php } ?>
<script language="JavaScript">
var newwindow;
function login_popup(url) {
	var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
	screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
	outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
	outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
	width    = 500,
	height   = 500,
	left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
	top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
	features = (
		'width=' + width +
		',height=' + height +
		',left=' + left +
		',top=' + top+
		',scrollbars=yes'
	);
	newwindow=window.open('login/'+url,'',features);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}
</script>