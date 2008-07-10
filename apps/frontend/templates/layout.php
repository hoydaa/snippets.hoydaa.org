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
                <br />
                <ul id="nav">
                    <li><?php echo link_to(__('&lt;post-snippet /&gt;'), 'snippet/create', array('title' => __('Post Snippet'))) ?></li>
                    <?php if (!$sf_user->isAuthenticated()): ?>
                    <li><?php echo link_to(__('signIn()'), '@sf_guard_signin', array('title' => 'Sign In')) ?></li>
                    <li><?php echo link_to(__('$sign_up'), 'user/register', array('title' => 'Sign Up')) ?></li>
                    <?php else: ?>
                    <li><?php echo link_to(__('Logout'), '@sf_guard_signout', array('title' => 'Sign Out')) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div id="bar-wrapper">
            <div id=bar>
                <?php echo form_tag('sfLucene/search', 'method=get class=search-controls') ?>
                	<?php if($sf_params->get('query')): ?>
                    	<?php echo input_tag('query', $sf_params->get('query')) ?> <?php echo submit_tag(__('Search')) ?>
                	<?php else: ?>
                	    <?php echo input_tag('query', 'tag: java, jee title: patterns author: John Doe', 
                		        array('onfocus' => 'this.value = ""; this.style.color = "#000000"', 
                		            'onblur' => 'this.value = "tag: java, jee title: patterns author: John Doe"; this.style.color = "#AAAAAA";', 
                		            'style' => 'color: #AAAAAA;')) ?> <?php echo submit_tag(__('Search')) ?>
                	<?php endif; ?>
                </form>
            </div>
        </div>
        <div id="main-wrapper">
            <div id="main">
                <div id="sidebar">
                    <?php if($sf_user->isAuthenticated()): ?>
                    <div id="sidebar-user">
                        <?php include_component('user', 'box') ?>
                    </div>
                    <br />
                    <?php endif; ?>
                    <div id="sidebar-snippets">
                        <?php include_component('snippet', 'most') ?>
                    </div>
                    <br />
                    <div id="sidebar-tags">
                        <?php include_component('tag', 'tagCloud') ?>
                    </div>
                </div>
                <div id="content">
                    <?php echo $sf_data->getRaw('sf_content') ?>
                </div>
            </div>
        </div>
        <div id="footer-wrapper">
            <div id="footer">
                <p>Copyright &copy; <?php echo date("Y") ?> Hoydaa Inc. All rights reserved.</p>
                <p><?php echo link_to(__('New Snippets'), 'feed/newCodes', 'class=feed') ?></p>
            </div>
        </div>
    </body>
</html>