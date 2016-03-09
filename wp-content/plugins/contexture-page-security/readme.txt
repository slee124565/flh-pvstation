=== Page Security & Membership ===
Contributors: Veraxus, Contexture
Donate link: http://www.contextureintl.com/
Tags: security, permissions, users, groups, page, post, membership, restricted
Requires at least: 3.3
Tested up to: 4.2
Stable tag: 1.5.15

Allows admins to create user membership groups and set access restrictions for any post, page or section.

== Description ==

Page Security & Membership lets YOU decide which users can access which content. Add users to groups, set granular permissions for content, and finally take control of your website!

Groups allow you to organize your users how YOU see fit, then use your groups to choose who can access posts, pages, custom content, or entire sections of your website.
Create an intranet or a members-only area with just a few clicks, or build a subscription based system with automatically expiring memberships. You can even create multiple levels
of security for powerful, granular protection of any sub-section on your site.

PSC is created to be simple, yet powerful - and is designed to integrate seamlessly and intuitively with WordPress. If you know how to use WordPress, you know how to use PSC.

= Features =
1. Easy to use and integrates seamlessly with WordPress.
1. Restrict your ENTIRE website (use WordPress as an intranet)!
1. Restrict categories, tags, or even custom taxonomy terms!
1. Subscription support! Set expiration dates for memberships.
1. Create customized "Access Denied" pages!
1. Fully Ajax-loaded! All your security updates are saved in real time!
1. A built-in "Registered Users" group allows you to quickly create "registered users only" sections.
1. Fully-documented, contextual help is provided for every PSC feature (via the WordPress 'Help' tab)!
1. Use simple, well-documented theme functions to easily automate your group memberships (You could even create an automatic subscription system)!
1. Professionally maintained with frequent updates and improvements based on YOUR feedback!

= Languages =
1. English
1. Italian (by Tristano Ajmone)
1. French (by Sparza Benoit)

== Installation ==

= Via WordPress Admin =

1. From your sites admin, go to Plugins > Add New
1. In the search box, type 'Page Security by Contexture' and press enter
1. Locate the entry for 'Page Security by Contexture' (there should be only one) and click the 'Install' link
1. When installation is finished, click the 'Activate' link

= Manual Install =

1. Upload `contexture-page-security` folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You're finished! Start using Contexture Page Security.

== Screenshots ==

1. screenshot-1.png
1. screenshot-2.png
1. screenshot-3.png
1. screenshot-4.png

== Frequently Asked Questions ==

= I get an error about PHP5 when I activate your plugin. What gives? =

As of version 1.5.2, Page Security requires PHP 5.2.4 and WordPress 3.2 or higher to work. If you receive an error message while activating/installing this plugin, you may need to upgrade your PHP installation (you are probably still running PHP4).
If you are using a web hosting service, simply contact your hosting provider about updating your default version of PHP (it's usually as simple as checking a box somewhere on your
hosting dashboard).

= Does Page Security work with WordPress 2.9 or earlier? =

As of Page Security 1.5.2, WordPress 3.2 is REQUIRED (due to a critical change in jQuery, this was unavoidable). Older versions of PSC (1.5.1 or earlier) may still work with older versions of WordPress.

= How does "Protect Entire Site" Work? =

This option is great for those who want to create private, intranet-like websites. When this option is enabled, only registered users will be able to access any part of the website while unauthenticated users are automatically denied access or redirected to the login screen.

Best of all, ALL SECURITY RESTRICTIONS you have created are still in effect, even if a user is registered. For instance, if a registered user (who has site-level access) tries to access content not enabled for their group, they will be denied access (just like normal).

This is powerful because it allows you to quickly and completely restrict site access to all unapproved users, while maintaining multiple levels of ADDITIONAL security for your content. To ensure your site is completely intranet-secure, remember to disable WordPress's "Anyone Can Register" setting.

= Can I help translate PSC into my language (or update an outdated translation)? =

Absolutely! PO files are now included with each PSC download. You can use a WordPress plugin like "CodeStyling Localization" or a program like "Poedit" to easily create language-specific translations. If you'd like us to include your translation in the official release, simply email it to opensource@contextureintl.com!

= Is there an easy way to make some sections admin-only? =

Yes! This is particularly handy if you're working on a new section of your website but you aren't quite ready to share it with the world. From the page's edit screen, simply find the "Restrict Access" sidebar and check "Protect this page and it's descendants". That's it! Even if you don't assign any groups, anyone who's logged in as an admin will still have full access to that page.

= If I protect a term (category, tag, etc) will it protect all the posts too? =

Yes. Whenever you add protection to a term, those permissions are automatically inherited by the content.

= Is there a way to give new users temporary group membership? =

Yes, although it involves a little bit of coding. Please see this thread on the WordPress Support Forum for details: http://goo.gl/oXDyh

= I found a bug or need a feature, what do I do? =

Please visit our official support page at http://goo.gl/Cw7v7 and we'd be glad to help you out.

= Can I help test out pre-release versions of PSC =

Absolutely. If you want access to all the newest features, and don't mind dealing with occasional bugs, visit our support page http://goo.gl/Cw7v7 and look for the "Development Build" option.

== Theme Functions ==

As of 1.4.x, Page Security is organized in a way that roughly corresponds to MVC guidelines. If you are a developer and want to take to extend any of PSC's features, it's usually as easily as calling any of the included static classes.

Most database-interaction functions can be found in /wp-content/plugins/contexture-page-security/core/queries.php - these are the same ones used by every facet of PSC and should be conveniently exposed to any other plugins or themes.

Here are just a few examples:

= Add a User to a Group =

$result = CTXPS_Queries::add_membership_with_expiration($user_id,$group_id);

= Add a User with Expiration =

$result = CTXPS_Queries::add_membership_with_expiration($user_id,$group_id,$expiration_date);

= Change Membership Expiration =

$grel_id = get_grel($user_id,$group_id);
$result = update_enrollment_grel($grel_id,$expiration_date);

= Get a List of Groups =

$result = CTXPS_Queries::get_groups();

= Get Protection Status of Current Page/Post =

$result = CTXPS_Queries::check_protection();

== Changelog ==

= 1.5.15 ( 2015/04/14 ) =
* Fixed an ajax bug that could prevent adding groups to users.
* Added an option that allows admins to selectively disable security for certain pages

= 1.5.13 ( 2015/03/22 ) =
* Bug fix.

= 1.5.12 ( 2015/03/20 ) =
* Maintenance update. Better IIS and CGI support.

= 1.5.11 ( 2014/05/09 ) =
* Fixed a bug that could result in admins accidentally unprotecting pages without realizing it.

= 1.5.10 ( 2013/11/13 ) =
* Squished a few more bugs (hopefully solves any remaining error/warning messages)

= 1.5.9 ( 2013/10/03 ) =
* Various other bug fixes (should solve most reported error messages and problems)
* Retina-screen icons.

= 1.5.8 =
* Deleting a WordPress user now updates Page Security too
* Built-in help documentation now uses WordPress 3.3+ new system

= 1.5.7 = 
* Improved WPML support when using Access Denied pages
* Menu filtering now handles protected terms that have been added to menus (if menu filtering is enabled)
* Further substantial improvements to term protection (categories, tags, etc).

= 1.5.6 =
* Major bug fix: Rewrote the term protection code. Categories, tags, and custom taxonomy terms should now behave as expected. Posts/pages with protected terms will now behave as if the term protections are attached directly to the post.
* A couple very minor UI tweaks.

= 1.5.5 =
* Fixed a bug that caused "Protect this page" to incorrectly return an error under WP 3.3
* More fixes and tweaks coming soon!

= 1.5.4 =
* Added a French translation (thanks, Sparza!)
* Fixed a bug that could prevent adding users with expiring memberships
* Fixed a potential security exploit
* Improved MS support based on community contributions

= 1.5.3 =
* Additional JavaScript improvements

= 1.5.2 =
* Fixed Membership Expiration for newer versions of WordPress
* WordPress 3.2 is now required (due to a critical change in jQuery)

= 1.5.1 =
* Minor aesthetic fix for admin sections

= 1.5.0 =
* New feature: You can now add security to taxonomy terms (categories, tags, or custom).
* Lots and lots and LOTS of usability improvements.
* Added %login_url% token for use with anonymous access denied messages. When used, the token auto-generates a login link with correct redirect.
* Updated readme to include more theme function examples

= 1.4.4 =
* Author page excerpts are now correctly filtered.

= 1.4.3 =
* Improved support for older PHP versions (5.1+)
* Improved PHP requirement checks
* Minor bug fixes and usability enhancements
* Added Italian translation (by Tristano Ajmone)

= 1.4.2 =
* Fixed a bug that caused the "Registered Users" group to misbehave (thanks Avotos & Gaurav!).
* Extended some CTXPS_Queries methods to be more useful to theme authors.
* Updated readme to reflect new usage of CTXPS_Queries methods in themes.

= 1.4.1 =
* Fixed a bug that caused site registration settings to be ignored for many users.

= 1.4.0 =
* COMPLETE CODE REWRITE! Code base is now now MUCH more flexible so new features should come more quickly.
* New feature: Full custom post type support!
* New feature: New "content replacement" option for those who want to protect content without a redirect.
* New feature: Protect an ENTIRE SITE with one click. Useful for intranet implementations.
* New feature: Use bulk actions to add users to groups!
* Updated permissions to be more common-sense (editors can now update content permissions, but only admins can add/remove users from groups).
* Fixed a bug with membership expirations.
* Lots and lots and lots of usability improvements.
* MORE FEATURES COMING SOON!