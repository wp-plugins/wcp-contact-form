=== WCP Contact Form ===
Contributors: webcodin
Tags: contact, contact form, form, contact me, contact us, contactus, contact form plugin, email, email message, notifications, admin notifications, customer notifications, customer, form to email, wordpress contact form, subscribe, CSV, CSV export, form builder, builder, captcha, validation, dynamic fields
Requires at least: 3.5.0
Tested up to: 4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: trunk

The contact form plugin with dynamic fields, CAPTCHA and other features that makes it easy to add custom contact form on your site in a few clicks

== Description ==

With the help of our plugin you can add an easy-to-setup contact form on the page or sidebar of your site. It's fully customizable, adjustable and ideally works as:

* Contact form for corporate site or a personal blog;
* Form of offline order in promotional catalog;
* Form for users feedback, testimonials;
* Application forms, support requests;
* And much more...

= Features =

* Contact form can be used as shortcode on the page or sidebar widget;
* Ready-to-use fields preset after plugin instalation includs following fields: Name, Email, Phone, Subject, Message and CAPTCHA;
* **NEW!** Dynamic form fields with the following field types: text, email, numeric, textarea, checkbox and CAPTCHA;
* **NEW!** Each field has following parameters for configuration: type, name, visibility, required and export to CSV;
* **NEW!** All fields can be reordered and deleted;
* "Submit" button can be customized with title, background and text colors;
* Possibility to use custom "Thank You" page that can be chosen from list of the existing pages;
* Optionally available HTML5 fields validation;
* Custom error messages for non-HTML5 fields validation;
* Auto notifications for users and administrator with variables for notification letters;
* Handy list of received messages with the ability to filter, delete to the Trash and group actions;
* 2 status for messages: read and unread;
* Separate page for each letter with detailed view and the ability to quickly remove to Trash;
* Form supports default theme styling;
* **NEW!** Export messages to CSV format.
* Developers have the possibility to customize the plugin by creating a duplicate templates and styles in the active theme folder.
 
= Notes =

* **Beware!** If you DELETE any field from existed form configuration all received data for this field won't be available for existed messages without possibility to restore.
* **NB!** If you use more than one email field you need to define field that will be used for user notification: "Contact Form" --> "Settings" --> "Notifications" --> "User Notifications" --> "User Email Field". By default, will be used first email field. Also, for properly work of user notifications email field should be required.
* **NB!** Form uses standard WordPress wp_mail() function (https://codex.wordpress.org/Function_Reference/wp_mail) for messages submission. If you have issues with notification receiving, try to use some third-party plugin for mail settings.
* **NB!** "Reset to default" button on the Settings page reset all tabs to default values includes form fields


= Upcoming Updates =

* contact form popup;
* form custom styles.

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

= How can I add a form to a sidebar =

Go to the "Appearance" --> "Widgets" sections.
Add "WCP Contact Form" to necessary sidebar, change sidebar title if you need and press "Save" button.

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).


= How can I to configure form fields =

To configure form fields go to the menu "Contact Form" > "Settings" tab "Form".
In the "Fields Settings" section will be available settings for the form fields.
Form supports following field types: text, email, numeric, textarea, checkbox and CAPTCHA.
Each field has following available parameters for configuration: 

* **type** - allows to choose field type from preset;
* **name** - allows to define field label for displaying; 
* **visibility** - allows to enable/disable field visibility; 
* **required** - allows to make field reqired;
* **export to CSV** - allows to add field to CSV export.
 
After all, press the "Save Changes" button at the bottom of the page.

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).

= Where can I find received messages =

To view the list of received messages go to the menu "Contact Form" > "Entries".
New messages are marked automatically as Unread. There is also automatic filtering for Read and Unread messages.
When you delete a message it goes to the "Trash". Deleted message is recoverable or can be completely removed.
You can use Mark as Read, Mark as Unread, Move to Trash actions on each message or the group.
Also on this page you able to export messages to CSV format by pressing on "Export to CSV" button.
Click on the name of the letter to review the letter details.

More information can be found in the section [screenshots](https://wordpress.org/plugins/wcp-contact-form/screenshots/).

= How can I export data to CSV =

To export the list of received messages go to the menu "Contact Form" > "Entries".
Press button "Export to CSV" at the top of the message list. All fiels that were defined as "Export to CSV" at the form settings will be exported to CSV format.

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

To change non-HTML5 validation error messages, go to menu "Contact Form" > "Settings" > "Errors" tab > "Error Messages" section.
Following options are available:

* **Required Field** - allows to change error message for required fields;
* **Email Field** - allows to change error message for fields with type email.
* **Captcha Field** - allows to change error message CAPTCHA field.
* **Number Field** - allows to change error message for fields with type number.

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

* **User Email Field** - allows to define default field for user notification if you use more than one email field;
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
9. Admin Panel :: Settings :: Form Tab :: Default Configuration
10. Admin Panel :: Settings :: Form Tab :: Custom Configuration
11. Admin Panel :: Settings :: Errors Tab
12. Admin Panel :: Settings :: Notifications

== Changelog ==

= 2.0.1 =
* changed: "Refresh" button styling for CAPTCHA field 
* minor styles changes

= 2.0.0 =
* global changes of the plugin core and templates structure. **Beware!** You can have issues if you make some customization in the form templates manually by code!;
* added possibility to dynamic setup of the form fields. Fields can be added, deleted and reordered;
* added following field types: numeric, checkbox;
* added export to CSV format;
* added setting for default user notification email for forms with multiple email fields;
* added additional error message for numeric field type;
* Fixed: Issue with fatal error when trying to activate plugin for PHP 5.3;
* Fixed: Issue for AJAX request with enabled Zlib-compression;

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
