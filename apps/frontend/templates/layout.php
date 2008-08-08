<?php use_helper('Validation', 'I18N', 'Javascript') ?>

<!DOCTYPE html PUBLIC
	"-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
    </head>
    <body>
        <div id="header-wrapper">
            <div id="header">
                <?php echo link_to(image_tag('logo.gif', array('alt' => __('snippets'), 'title' => __('snippets by hoydaa'), 'id' => 'logo')), '@homepage') ?>
                <ul id="nav">
                    <li><?php echo link_to(__('&lt;post-snippet /&gt;'), 'snippet/create', array('title' => __('Post Snippet'))) ?></li>
                    <?php if (!$sf_user->isAuthenticated()): ?>
                    <li><?php echo link_to(__('signIn()'), '@sf_guard_signin', array('title' => 'Sign In')) ?></li>
                    <li><?php echo link_to(__('$sign_up'), 'user/register', array('title' => 'Sign Up')) ?></li>
                    <?php else: ?>
                    <li><?php echo link_to(__('Sign::OUT'), '@sf_guard_signout', array('title' => 'Sign Out')) ?></li>
                    <?php endif; ?>
                </ul>
                <div class="right-aligned" style="padding-top: 75px;">
                	(v <?php echo sfConfig::get('app_version') ?>)
                </div>
            </div>
        </div>
        <div id="bar-wrapper">
        	<div id="bar">
        	    <div class="right-aligned">
        	        <?php 
        	        $arr = array();
        	        if (!$sf_user->isAuthenticated()) {
        	            $arr = array('disabled' => 'disabled');
        	        }?>
        	        <div id="msg-container" style="display: none;"></div>
	                <?php echo button_to_remote(
	                    __('Save Preferences'),
	                    array(
	                        'url' => 'user/savePreferences',
	                        'update' => 'msg-container',
	                        'complete' => "window.alert($('msg-container').innerHTML);"
	                    ),
	                    $arr
	                ) ?>
	            </div>
	            <div>
	                <?php echo form_tag('sfLucene/search', array('method' => 'get')) ?>
	                	<?php if($sf_params->get('query')): ?>
	                    	<?php echo input_tag('query', $sf_params->get('query'), array('class' => 'search')) ?> <?php echo submit_tag(__('Search')) ?>
	                	<?php else: ?>
	                	    <?php echo input_tag('query', 'tag: java, jee title: patterns author: John Doe', 
	                		        array('onfocus' => 'this.value = ""; this.style.color = "#000000"', 
	                		            'onblur' => 'this.value = "tag: java, jee title: patterns author: John Doe"; this.style.color = "#AAAAAA";', 
	                		            'style' => 'color: #AAAAAA;',
	                		            'class' => 'search')) ?> <?php echo submit_tag(__('Search')) ?>
	                	<?php endif; ?>
	                </form>
	            </div>
            </div>
        </div>
        <div id="main-wrapper">
            <div id="main">
                <div id="sidebar">
                    <?php include('right.php'); ?>
                </div>
                <div id="content">
                    <?php echo $sf_data->getRaw('sf_content') ?>
                </div>
            </div>
        </div>
        <div id="footer-wrapper">
            <div id="footer">
                <ul id="footer-nav">
                    <li><?php echo link_to(__('about us'), '@content?template=about', array('title' => 'About Us')) ?> |</li>
                    <li><?php echo link_to(__('contact us'), '@content?template=contact', array('title' => 'Contact Us')) ?></li>
                </ul>
                <p><?php echo link_to(image_tag('feed.png'), 'feed/newCodes') ?> <?php echo link_to(__('New Snippets'), 'feed/newCodes') ?></p>
                <p>Copyright &copy; <?php echo date("Y") ?> <?php echo link_to('Hoydaa Inc.', 'http://www.hoydaa.org', array('target' => '_blank', 'title' => 'deliver few, deliver complete')) ?> All rights reserved.</p>
            </div>
        </div>
       
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            var pageTracker = _gat._getTracker("UA-794867-8");
            pageTracker._initData();
            pageTracker._trackPageview();
        </script>
    </body>
</html>