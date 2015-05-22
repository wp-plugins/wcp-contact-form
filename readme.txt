=== WCP Contact Form ===
Contributors: webcodin
Tags: contact, contact form, form, contact me, contact us, contactus, contact form plugin, email, email message, notifications, admin notifications, customer notifications, customer, form to email, wordpress contact form 
Requires at least: 3.5.0
Tested up to: 4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: trunk

Quickly add simple contact form to your site and easily adjust it to your needs.

== Description ==

With the help of our plugin you can add an easy-to-setup contact form for the page or sidebar of your site. It's fully customizable, adjustable and ideally works as:

* Contact form for corporate site or a personal blog;
* Form of offline order in promotional catalog;
* Form for users feedback, testimonials;
* Application forms, support requests;
* And much more...

= Features =

* Can be used on the page as shortcode or widget;
* Customize entry fields for your needs;
* Change the name of fields and add "required" parameter;
* Disable fields which are not necessary;
* Optional CAPTCHA field;
* Customize "submit" button with title, background and text colors;
* Redirection to your own "Thank You" page after a successful submitting if needed;
* Optionally available HTML5 fields validation;
* You can modify the text of errors for normal fields validation;
* Set up notifications for user and administrator;
* Variables for notification letters;
* Handy list of received messages with the ability to filter and delete to the Trash;
* 2 status for messages available: read and unread;
* Group actions on messages;
* Separate page for each letter with detailed view and the ability to quickly remove to a basket;
* Developers have the possibility to customize the plugin by creating a duplicate templates and styles in the active theme folder.

**NB! Form uses standard WordPress wp_mail() function (https://codex.wordpress.org/Function_Reference/wp_mail) for messages submission. If you have issues with notification receiving, try to use some third-party plugin for mail settings.**

= Upcoming Updates =
* subscribe option
* export of received emails to .csv format

= 3 easy steps to start using of our contact form on a page =
1. check plugin "Settings" page and customize form options for your purposes;
2. create new page or use existed;
3. add shordcode to the TinyMCE editor with unique ID, as sample **[scfp id="my_contact_form"]** and save the page
... and that is all! You have a fully working contact form on your site page

= 3 easy steps to start using of our contact form at a sidebar =
1. check plugin "Settings" page and customize form options for your purposes;
2. go to the "Appearance" --> "Widgets" sections;
3. add "WCP Contact Form" to necessary sidebar 
... and that is all! You have a fully working contact form at the sidebar on your site

More information and documentation can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/) and [FAQ](https://wordpress.org/plugins/wcp-contact-form/faq/).

If you want to help with plugin improvement, please leave your feedback or suggestions for future updates.

== Installation ==

1. Download a copy of the plugin
2. Unzip and Upload 'wcp-contact-form' to a sub directory in '/wp-content/plugins/'.
3. Activate the plugins through the 'Plugins' menu in WordPress.
4. Add shortcode [scfp id="unique-form-id"] on Your page

== Frequently Asked Questions ==

= How can I add a form to a page =

To create a new page for the contact form, go to the menu "Pages" > "Add New". 
After filling all needed fields, please add to the description of the page next shortcode and save the page: 

`[scfp id="unique-form-id"]`

As a result, ready to use form will appear on page with default configuration.

The form can be also added to an existing page. To do this, go to the menu "Pages" > "All Pages". Open for editing the necessary page and insert shortcode in the right place in description and save the page. 

**Shortcode examples**

`[scfp id="my-form"]`

`[scfp id="my-form-1"]`

`[scfp id="form1"]` 

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).


= How can I to configure form fields =

To configure form fields go to the menu "Contact Form" > "Settings" tab "Form".
In the "Fields Settings" section will be available settings for the form fields.
Form can contain **maximum five** fields: Name, Email, Phone, Subject and Message. And **minimum two**: Email and Message.
Displaying and "required" settings for fields such as Name, Phone and Subject can be changed depending on your needs.
After all, press the "Save Changes" button at the bottom of the page.

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).

= Where can I find received messages =

To view the list of received messages go to the menu "Contact Form" > "Entries".
New messages are marked automatically as Unread. There is also automatic filtering for Read and Unread messages.
When you delete a message it goes to the "Trash". Deleted message is recoverable or can be completely removed.
You can use Mark as Read, Mark as Unread, Move to Trash actions on each message or the group.
Click on the name of the letter to review the letter details.

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).

= How can I customize "Send" button? =

To change Send button, go to menu "Contact Form" > "Settings" > "Form" tab > "Send Button" section. 
Following options are available:

* **Caption** - allows to change button text;
* **Background Color** - allows to change button background color;
* **Text Color** - allows to change button text color.

= How can I use own "Thank You" page? =

To choose own Thank You page, go to menu "Contact Form" > "Settings" > "Form" tab > "Thank You Page" section. 
Following options are available:

* **Page** - allows to choose existed page from the dropdown list and use it as Thank You page.

= How can I enable HTML5 validation? =

To eneble HTML5 validation, go to menu "Contact Form" > "Settings" > "Form" tab > "HTML5 Validation" section and check Enabled checkbox.

= How can I change validation error messages? =

To change normal validation error messages, go to menu "Contact Form" > "Settings" > "Errors" tab > "Error Messages" section.
Following options are available:

* **Required Field Error** - allows to change error message for required fields;
* **Email Field Error Message** - allows to change error message for email field.

= How can I change administrator notifications? =

To change administrator notifications, go to menu "Contact Form" > "Settings" > "Notifications" tab > "Admin Notifications" section.
Following options are available:

* **Send to Email** - allows to set email address for administrator notifications;  default email address is used from: Settings > General > E-mail Address
* **Subject** - allows to change default subject of administrator notification message;
* **Message** - allows to change default text of administrator notification message.
* **Disable Admin Notifications** - allows to disable notifications of new form submissions. 

= How can I change user notifications? =

To change user notifications, go to menu "Contact Form" > "Settings" > "Notifications" tab > "User Notifications" section.
Following options are available:

* **Subject** - allows to change default subject of user notification message;
* **Message** - allows to change default text of user notification message.
* **Disable User Notifications** - allows to disable notifications for successful form submission. 

= How can I style the form content? =

The plugin includes CSS file "assets/css/style.css".
You can copy this file in your active theme and customize it for your needs.
Path to the styles inside the active theme:

[ActiveTheme]/templates/wcp-contact-form/assets/css/style.css

= How can I change the form content? =

The plugin includes some templates in "templates/" folder. 
You can copy any template in your active theme and customize it for your needs. 
Path to the templates folder inside the active theme:

[ActiveTheme]/templates/wcp-contact-form/


== Screenshots ==

1. Form Sample
2. Form Sample
3. Form Sample :: Widget
4. Form Shordcode
5. Form Widget
6. Entries
7. Entries :: Group Actions
8. Entries :: Detail
9. Admin Panel :: Settings :: Form Tab
10. Admin Panel :: Settings :: Errors Tab
11. Admin Panel :: Settings :: Notifications

== Changelog ==

= 1.2.0 =
* global changes of the plugin core;

= 1.1.0 =
* added form widget;
* added optional CAPTCHA field and editable error message;
* added ability to reset form options to default;
* added variables for notification messages;
* general cleanup and optimization;

= 1.0.0 =
* initial release.
