THIS IS FOR BEGINNER DEVELOPERS

## NOTE:  Create a plugin file, zip it, upload it on wordpress (local),
go to folder C:\xampp\htdocs\wordpress\wp-content\plugins\ &lt;YOUR PLUGIN NAME&gt; <br/>
Open it on VSCode, edit there, and check changes in real-time
------------------------------------------------------------------------------



<h6>1st: </h6>
Always have different function names of your other version of a pluginotherwise your would have to deactivate one to us another. (dont know usecase where both are used at a time btw)


<h6>2nd:</h6>
To check debug logs add
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true);
define( 'WP_DEBUG_DISPLAY', false);
in C:\xampp\htdocs\wordpress\wp-config.php

This is the way to check errors in your code.





FACED ISSUES:

Issue 1:
A fatal error occurred due to a function name conflict (enqueue_custom_plugin_assets()) in two plugins: fleetily-wordpress-plugin and new-fleetly-plugin-wordpress.

Solution:
Renamed the function in new-fleetly-plugin-wordpress to enqueue_new_fleetly_plugin_assets() to avoid the conflict.
Alternative option: Deactivate one plugin to prevent the issue.
Optional: Merge both plugins to streamline the code and avoid future conflicts.
This resolved the fatal error and cleared the function conflict.

