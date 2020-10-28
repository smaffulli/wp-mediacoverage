# wp-mediacoverage
Custom post type and taxonomy to record mentions in press, tv and other media.


## How to create a new Press Mention (Media Coverage)
From WP Admin click “Media Coverage” and “Add New Mention”. This will open
the WordPress editor. You only need to enter a title and the URL of the mention
below the editor. The content of the post will be ignored, you can skip it.

Set the Featured Image to match the publication: search the Media folder for
the existing logos. Add a logo for publications mentioning us for the first time. 
The Media Coverage post type introduces also a new taxonomy: Outlets. These are
used to categorize the coverage by media outlet. For example, a mention from
TechCrunch will be attributed to Outlet “TechCrunch”.
Hit Publish and you’re done. 

## Customize your theme to properly display the mentions
I used [Divi FilterGrid module](https://diviplugins.com/documentation/divi-filtergrid/)
and Divi Theme Builder to create a custom archive page where the title of the Press
Mention is linked to the custom URL.
