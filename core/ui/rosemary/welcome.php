<?php

/**
 * User Welcome Page
 * 
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

add_action('rosemary_render_welcome', function(){
?>

    <script src="https://desk.zoho.com/portal/api/feedbackwidget/493135000000212760?orgId=713883891&displayType=popout"></script>


    <div class="wrap">

        <nav class="nav-tab-wrapper woo-nav-tab-wrapper">

            <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab" ?>"
               class="nav-tab <?php echo $_GET['tab'] == '' ? 'nav-tab-active' : '' ?>">Home</a>
            <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab=dev" ?>"
               class="nav-tab <?php echo $_GET['tab'] == 'dev' ? 'nav-tab-active' : '' ?>">For Developer</a>
            <a href="<?php echo $_SERVER['REQUEST_URI'] . "&tab=online" ?>"
               class="nav-tab <?php echo $_GET['tab'] == 'online' ? 'nav-tab-active' : '' ?>">Online</a>

        </nav>

        <?php if ($_GET['tab'] == 'online'): ?>

            <div class="wrap">
                <div class="root">

                    <h2>Open knowledge base</h2>
                    <p>Go to page - <a href="https://desk.zoho.com/portal/irtex/kb/web-template">https://desk.zoho.com/portal/irtex/kb/web-template</a></p>

                </div>
            </div>

        <?php elseif ($_GET['tab'] == 'dev'): ?>

            <div class="wrap">
                <div class="root">

                    <h2>Fast navigation</h2>

                    <ol>
                        <li><a href="#fast_start">Fast start</a></li>
                        <li><a href="#create_block">How create block and register element</a></li>
                        <li><a href="#register-element">Register element</a></li>
                        <li><a href="#package-manager">Package manager in blocks</a></li>
                        <li><a href="#block-options">How to register block options</a></li>
                        <li><a href="#create-option">Create option type</a></li>
                        <li><a href="#options-type">Default IDs for options</a></li>
                        <li><a href="#include_font">How to include font</a></li>
                        <li><a href="#rt_info">Real-time system information</a></li>
                    </ol>

                    <div id="fast_start">

                        <h3>Fast start</h3>
                        <p>To get started, download the "<a href="<?php echo get_admin_url(); ?>admin.php?tab=install&s=A+block+for+developers&page=rosemary_render_blocks_manager">developer block</a>" from the store</p>
                        <p>Go to reading repository <a href="https://github.com/<?php echo ROSEMARY_GIT; ?>">https://github.com/<?php echo ROSEMARY_GIT; ?></a></p>

                    </div>

                    <div id="create_block">

                        <h3>Create block</h3>

                        <p>Each block is registered by calling a function to which the HTML code of this block will be passed</p>
                        <p>The function that registers is called as:</p>

                        <samp><var>$void = </var><font color="#B26C32"><u>rosemary_register</u></font> (<var>$id_template</var>, function (<var>$e</var>=null) {<br><font color="green">&emsp;&nbsp;    // You code here</font><br>}, array (<br>&emsp;&nbsp;    '<b>title</b>' => 'Developer Kit', <br>&emsp;&nbsp;    '<b>description</b>' => 'Block for developer', <br>&emsp;&nbsp;    '<b>author</b>' => 'Mirele'<br>));</samp>

                        <h3 id="register-element">Register element</h3>

                        <p>You can register elements inside each such function.</p>
                        <p><b>What is an element?</b> Element - the part of content/code that is user can change. Your element may be can register as:</p>

                        <ol>
                            <li>Image ID (type:<sub>1</sub> src)</li>
                            <li>Video ID (type:<sub>1</sub> src)</li>
                            <li>Text (type:<sub>1</sub>text, any)</li>
                            <li>Shortcode (type:<sub>1</sub> any)</li>
                            <li>HTML (type:<sub>1</sub> any, html)</li>
                        </ol>

                        <p>The function responsible for registering an element looks like this:</p>

                        <samp><var>$value = </var><font color="#B26C32"><u>rre</u></font> (<var>$id_element</var>, [<br>
                            &emsp;&nbsp;    '<b>type</b>'<sub>1</sub> => 'text',<br>
                            &emsp;&nbsp;    '<b>value</b>' => 'Hello, Mirele!'<br>], array ( <br>
                            &emsp;&nbsp;    '<b>color</b>' => 'red', <br>
                            &emsp;&nbsp;    '<b>font-size</b>' => '18px' <br>
                            ));</samp>

                        <h3 id="package-manager">Package manager | <small>Connecting data from external servers / version control </small> </h3>

                        <p>Mirele has a universal function for advanced registration of data in templates. This function is the batch data Manager:</p>

                        <samp>
                            <font color="#3E70AC">global</font> <var>$mpackage</var>;
                            <br><br>
                            <var>$object</var> = <var>$mpackage</var>-><font color="#B26C32"><u>register</u></font>('template', array (<br>
                            &emsp;&nbsp;    '<b>css</b>' => [<br>&emsp;&nbsp;    &emsp;&nbsp;    'https://cdn.com/my-css.css'<br>&emsp;&nbsp;    ],<br>
                            &emsp;&nbsp;    '<b>js</b>' => []<br>
                            ), <var>$id_element</var>);<br>
                        </samp>

                        <p>Each of your registered styles will be cached for several days</p>

                        <h3 id="block-options">Register block options</h3>

                        <p>As mentioned earlier, all block content must fit within the rosemary_register function. Also inside this function you can indicate options for your block</p>
                        <p>Block options are unlimited in number, but it is not advisable to make them more than 100</p>

                        <samp>

                            <var>$options</var> = <font color="#B26C32"><u>rosemary_register_block_options</u></font> (array (<br>
                            &emsp;&nbsp;    '<b>option</b>' => 'default value'<br>
                            ));

                        </samp>

                        <p>In the <var>$options</var> variable you get user-edited options</p>

                    </div>

                    <div id="create-option">

                        <h3>Create option type</h3>

                        <p>By default, each of your options is treated as plain text. To declare an option as a choice of several options, color choice, etc., you must either use ready-made options or register your option type</p>

                        <samp>

                            <var>$void</var> = <font color="#B26C32"><u>rosemary_register_option</u></font> (<var>$id_option</var>, <var>$type_option</var>, [<br>

                            &emsp;&nbsp;    array (<br>
                            &emsp;&nbsp;    &emsp;&nbsp;    '<b>title</b>' => 'title',<br>
                            &emsp;&nbsp;    &emsp;&nbsp;    '<b>value</b>' => 'value'<br>
                            &emsp;&nbsp;    ),<br>

                            ], <var>$title_option</var>, <var>$note_option</var>);

                        </samp>

                        <hr>

                        <h4>Type options (<var>$type_option</var>)</h4>

                        <table id="options-type" class="wp-list-table widefat fixed striped posts" width="50%">

                            <thead>
                            <tr>
                                <th>Type (<var>$type_option</var>)</th>
                                <th>Short-description</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>

                                <th>choice</th>
                                <th>Selection dialog</th>
                                <th>Displays a selection dialog from the transferred options. Variants should be enclosed in an array and have the form:
                                    <br><br>
                                    a) [array ('title' => '', 'value' => '')]
                                    <br><br>
                                    b) ['value']
                                    <br><br>
                                    In the first case, the 'title' values ​​will be displayed as options shown to the user, and the 'value' values ​​will be used as the stored values</th>

                            </tr>

                                <tr>

                                    <th>number</th>
                                    <th>Input number</th>
                                    <th>Displays a field for entering a integer.</th>

                                </tr>

                                <tr>

                                    <th>function</th>
                                    <th>Performs a function as an output of an option field</th>
                                    <th>You can pass a function to the argument "avaiable" with the field type "function". In this case, you will get the output of the function as a field for entering the value. The function can take an array from the "option" and "value" elements. The "option" element holds the current option. The "value" element stores the value of the option. </th>

                                </tr>

                            </tbody>

                        </table>

                        <hr>

                        <hr>

                        <h4>Defaults options (<var>$id_option</var>)</h4>

                        <table id="options-type" class="wp-list-table widefat fixed striped posts" width="50%">

                            <thead>
                            <tr>
                                <th>ID (<var>$id_option</var>)</th>
                                <th>Short-description</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>

                                <th>color</th>
                                <th>Color picker</th>
                                <th>Displays a color picker dialog. Powered by WordPress API (ColorPicker). Understands the names of the colors at the input (red, blue, orange and e.t.c)</th>

                            </tr>

                            <tr>

                                <th>font</th>
                                <th>Font picker</th>
                                <th>Mirele has a collection of fonts (900+ fonts). You can let the user select a font from this collection. After choosing, you will need to connect the font using a
                                    <a href="#include_font">special function</a></th>

                            </tr>

                            <tr>

                                <th>icon</th>
                                <th>Icon picker</th>
                                <th>You can provide a selection of icons for the user. As a result of the selection, you will get the FontAwesome class. You can use it without processing. Example: &lt;i class = "$option"&gt; &lt;/i&gt;</th>

                            </tr>

                            </tbody>

                        </table>

                        <hr>

                    </div>

                    <div id="include_font">

                        <h3>Include font</h3>

                        <p>Mirele has the ability to connect one of the 900 fonts in the Google Fonts collection</p>
                        <p>To do this, you need to know the name of the font (if you use the result of a custom selection using the "font" option, option value = font name)</p>

                        <samp>
                            <var>$css</var> = <font color="#B26C32"><b>MResources</b></font>::<font color="#B26C32"><u>include_font</u></font> (<var>$name</var>)
                        </samp>

                        <p>If you connect the font before displaying the site header (outside the rre () function), the script will be transferred to the header automatically.</p>
                        <p>If not, then you need to execute the output of the function to the screen (the function returns the &lt;style&gt; tag)</p>

                    </div>

                    <div id="rt_info">

                        <h3>Real-time system information</h3>
                        <h4>Bootloader:</h4>

                        <?php global $bootloader_path; foreach ($bootloader_path as $path): ?>
                            <p> <b><?php echo $path->name ?></b> <?php echo $path->filename ?> </p>
                        <?php endforeach; ?>

                        <h4>Successfully registered blocks:</h4>

                        <?php foreach (rosemary_get_available_blocks()->blocks_functions as $block => $function): ?>
                            <p> <b><?php echo $block ?></b> Function: <?php var_dump($function); ?> </p>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

        <?php else: ?>

            <div class="wrap">

                <div class="mrl-column-1-1">
                    <div class="root">

                        <h2>Fast navigation</h2>

                        <ol>
                            <li><a href="#">The first acquaintance</a></li>
                            <li><a href="#create_page">Create page</a></li>
                            <li><a href="#create_block">Create block</a></li>
                            <li><a href="#create_wp_page">Creating a WordPress Page</a></li>
                            <li><a href="#edit_block">Edit block</a></li>
                            <li><a href="#edit_element_shadow">How to use Dynamic shadows</a></li>
                            <li><a href="#gallery">How to create a gallery</a></li>
                            <li><a href="#hubspotform">How to create a HubSpot form</a></li>
                            <li><a href="#migration">Migration (Export/Import)</a></li>
                            <li><a href="#installotherblocks">Install other blocks</a></li>
                            <li><a href="#updates">Free updates</a></li>
                            <li><a href="#support">Support</a></li>
                        </ol>


                        <h2>Documentation</h2>

                        <div id="create_page">

                            <h3>Create page</h3>

                            <p> After you first opened the Mirele editor, you noticed that you have several new menu items in the WordPress admin panel </p>

                            <img src="<?php echo PATH_ADMIN_PANEL; ?>" class="doc-image">
                            <p>To create a new Mirele page, you need to go to the "Mirele Pages" menu, which you can do from the WordPress admin menu</p>
                            <p>In the page manager menu ("Mirele Pages") you are greeted with an absolutely empty table of your pages</p>

                            <img src="<?php echo PATH_EMPTY_PAGES; ?>" class="doc-image">
                            <p>To start editing a page, you need to create it by clicking on the appropriate button above the table</p>

                            <img src="<?php echo PATH_CREATE_NEW_PAGE; ?>" class="doc-image">
                            <p>At this point, you should come up with a name for your page. For example: New</p>

                        </div>

                        <div id="create_block">

                            <h3>Create a new block</h3>

                            <p>On a blank editable page in the panel next to the header there are control buttons. To create a page you need to click on the appropriate button.</p>
                            <p>At your choice: "Create block" & "Create custom block"</p>
                            <p>1. <b>Create block</b> - will open a modal window to select existing blocks</p>
                            <p>2. <b>Create custom block</b> - opens a modal window for entering a unique block ID (if one, for one reason or another, has not been indexed for the first block selection option)</p>
                            <p>We recommend using the first option</p>
                            <p>A modal window appears in front of you, in which you can select the block you need</p>

                            <img src="<?php echo PATH_CREATE_NEW_BLOCK; ?>" class="doc-image">
                            <p>How does this menu work?</p>
                            <p>1. <b>Search Box</b> - search menu. You can search through it for blocks</p>

                            <img src="<?php echo PATH_SEARCH_BLOCK; ?>" class="doc-image">
                            <p>2. <b>Meta Information</b> - Each block has its own title, author, description - from this information you can find the block you need</p>
                            <p>3. <b>Color dot</b> - This dot has its own unique color. If you get confused in blocks, you can remember the colors of the necessary blocks to quickly navigate them</p>

                            <img src="<?php echo PATH_POINT; ?>" class="doc-image">
                            <p>4. <b>Add Button</b> - This is the button to add a block to the page. </p>

                        </div>

                        <div id="create_wp_page">

                            <h3>Creating a WordPress Page</h3>
                            <p>You can embed any Mirele page on any WordPress page.</p>
                            <p>To do this, go to the page editor menu and select "Create WordPress page"</p>

                            <img src="<?php echo PATH_CREATE_WP_PAGE; ?>" class="doc-image">
                            <p>After clicking on this menu item, you will be taken to a finished WordPress page</p>
                            <p>After returning back, you will be provided with a link to the page. You can use it as your homepage.</p>

                            <img src="<?php echo PATH_CREATED_WP_PAGE; ?>" class="doc-image">
                            <br>
                            <img src="<?php echo PATH_SELECT_WP_HOME_PAGE; ?>" class="doc-image">
                            <p>At this point, you already know how to create and edit Mirele pages.</p>
                            <p>Congratulations on taking the Mirele Mini Learning Path</p>

                        </div>

                        <div id="edit_block">

                            <h3>Edit blocks</h3>
                            <p>After creating the block, you have the opportunity to change the available parameters in it</p>
                            <p>We will understand the work of the first block (it will be easy)</p>
                            <p>Create the block "Colorful Header"</p>

                            <img src="<?php echo PATH_HEADER_SHOW; ?>" class="doc-image">
                            <p>Each block has an elements ID.</p>

                            <img src="<?php echo PATH_ID_IN_BLOCK; ?>" class="doc-image">
                            <p>These IDs logically correspond to the elements of the block.</p>
                            <p>Let's try to edit the header of the header.</p>

                            <img src="<?php echo PATH_EDIT_TITLE_BLOCK; ?>" class="doc-image">
                            <p>Do not forget to save the changes in the block!</p>

                            <img src="<?php echo PATH_SAVE_BLOCK_INFO; ?>" class="doc-image">
                            <img src="<?php echo PATH_NEW_INFO_BLOCK; ?>" class="doc-image">
                            <p>Happened! Block changed its title</p>
                            <p>Some elements have options</p>

                            <img src="<?php echo PATH_EDIT_OPTIONS; ?>" class="doc-image">
                            <p>And by clicking on this link you can edit the item</p>

                            <img src="<?php echo PATH_NEW_OPTIONS; ?>" class="doc-image">
                            <p>This button has a link, we can change it. By analogy with blocks - do not forget to save changes</p>
                            <p><b>Attention.</b> Some options have separate documentation. Go down below to find an explanation of some options for the item.</p>
                            <p>Some elements can be hidden by unchecking the item "Visible". To find the best block solution for yourself - experiment</p>

                            <img src="<?php echo PATH_MOVE_BLOCK; ?>" class="doc-image">
                            <p>You can move blocks in places</p>
                            <p>Grasp the block and pull it in the desired direction</p>
                            <p>Then release and he will automatically save his new position</p>

                        </div>

                        <div id="edit_element_shadow">

                            <h3>Dynamic shadows in pictures and videos</h3>

                            <p>You can edit the dynamic shadow on some images and video files. This shadow will be cast when the user reaches the element with the shadow. Shadow color - the average color of the element</p>
                            <img src="<?php echo PATH_CREATE_DS; ?>" class="doc-image">

                            <p>There are several types of shadows</p>

                            <ol>
                                <li>shadow-and-border
                                    <img src="<?php echo PATH_DS_T1; ?>" class="doc-image">
                                </li>

                                <li>filter
                                    <img src="<?php echo PATH_DS_T2; ?>" class="doc-image">
                                </li>

                                <li>shadow
                                    <img src="<?php echo PATH_DS_T3; ?>" class="doc-image">
                                </li>

                                <li>filter-shadow-bottom
                                    <img src="<?php echo PATH_DS_T4; ?>" class="doc-image">
                                </li>
                            </ol>

                            <p>If you don't want to display the shadow on an element, specify "<b>no</b>" in "<b>Dynamic_shadow</b>"</p>
                            <p>If you want to set a delay (the user scrolls to the element, the site waits for N seconds and shows the shadow), set the number (1s = 1000) to <b>Dynamic_shadow_timeout</b></p>

                        </div>

                        <div id="gallery">

                            <h3>Create gallery</h3>

                            <p>To create a gallery, you need to: <u>go to the block editor</u> > <u>open the block collection</u> > <u>find the "gallery" block</u></p>

                            <img src="<?php echo PATH_CREATE_GALLERY_BLOCK_GIF; ?>" class="doc-image">

                            <p>Then go to the Gallery app and you will be can to edit gallery photos</p>

                            <img src="<?php echo PATH_EDIT_GALLERY_GIF; ?>" class="doc-image">

                            <small>PS: You can't create more than 1 gallery per page</small>
                            <p>
                                <small>You can <a href="<?php echo get_admin_url(); ?>admin.php?tab=install&s=gallery&page=rosemary_render_blocks_manager">search for blocks of galleries in the market</a>, if you need other working conditions with the gallery</small>
                            </p>

                        </div>

                        <div id="hubspotform">
                            
                            <h3>Create HubSpot forms</h3>

                            <p>Log in to the HubSpot system by entering your token (hapi key) in the "Hubspot from Mirele" app</p>

                            <img src="<?php echo PATH_HLOGIN_GIF; ?>" class="doc-image">

                            <p><a href="https://app.hubspot.com/forms/">Create</a> your form in the HubSpot editor</p>
                            
                            <img src="<?php echo PATH_HCREATE_GIF; ?>" class="doc-image">

                            <p>After creating the form, you should publish it by clicking on the "Publish" button"</p>

                            <img src="<?php echo PATH_HPUBLISH_GIF; ?>" class="doc-image">

                            <p>For example I created a small and simple form for collecting tickets</p>

                            <p>Then go to the "HubSpot from Mirele" app and scroll to the "Forms"table. Search the table for the required form and copy its ID.</p>

                            <img src="<?php echo PATH_HCOPYID_IMG; ?>" class="doc-image">

                            <p>Next (at the request of "<b>HubSpot</b>") we find the necessary block in the block collection. And add it to page</p>

                            <img src="<?php echo PATH_HSEARCH_IMG; ?>" class="doc-image">

                            <p>The next step is to change the "Form_id" option on the "Submit" element. In the Form_id field, enter the form ID previously copied</p>

                            <img src="<?php echo PATH_HHOVER_IMG; ?>" class="doc-image">

                            <p>To where the <font color="red"><b>red arrow</b></font> points may be a space. It needs to be removed</p>

                            <img src="<?php echo PATH_HEDITID_IMG; ?>" class="doc-image">

                            <p>If you did everything correctly, the form will be loaded successfully.</p>
                            <p>PS: The form is updated automatically. All changes in the form of the HubSpot account will immediately be displayed on the site (if the cache is disabled)</p>

                            <img src="<?php echo PATH_HCOMPLITE_IMG; ?>" class="doc-image">


                        </div>

                        <div id="migration">

                            <h3>Migration (Export and Import)</h3>
                            <p>To export a set of blocks, just go to the desired page and click on the "Export" button (in the control unit)</p>
                            <p>After export approval in the modal menu, a block file is downloaded to your computer. You can import it to another page or to another site</p>

                            <p>To import a block, go to the desired Mirele page and select the "Import" button</p>

                            <img src="<?php echo PATH_IMPORT_BLOCKS; ?>" class="doc-image">
                            <p>After choosing the correct block file, you will be asked if you really want to import blocks (in the modal window you can see which blocks will be imported)</p>
                            <p>After successful import, your page will reload and you will see new blocks on your page</p>

                        </div>

                        <div id="installotherblocks">

                            <h3>Install other blocks</h3>

                        </div>

                        <div id="updates">

                            <h3>Free updates</h3>

                            <h2>Updates are completely free for you as a buyer</h2>
                            <p> The Mirele project has a version control system. If you bought the product "Mirele 1", then you will receive updates only for this version of the product </p>
                            <p> Mirele can also be issued in different editions: "Small", "Enterprise". Buyers of these versions cannot receive updates for "Mirele V1" </p>
                            <p> However, you, as a buyer of version 1, cannot receive an update for "Enterprise" or "Small" </p>
                            <p> Product versions are divided into snapshots and mask subversions *. *. *. This means that you can get about 100+ updates to your version </p>

                            <p>Note that version Mirele 2 or later is a different product. It looks very little like the current version and is delivered separately</p>


                        </div>

                        <div id="support">

                            <h3>Support</h3>

                            <p>If you have any problems, you can create a <a href="javascript:$('#feedbacklabelspan').click();">fast ticket</a> or write to the technical support mail - mirele_support@irtex.zohodesk.com</p>
                            <small>* Your applications will be reviewed within 1 hour to 2 days</small>

                        </div>

                    </div>
                </div>

                <div class="mrl-column-1-2 mrl-box-note">
                    <h3>Hello!</h3>
                    <p>You are in the administrative integration control panel.</p>
                    <p>Here you can configure the application and get the necessary statistics.</p>
                    <p>Integration manuals you can find in the knowledge base</p>
                </div>

            </div>

        <?php endif; ?>

    </div>

<?php
});