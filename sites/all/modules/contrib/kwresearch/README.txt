; $Id $

DESCRIPTION
--------------------------
The Content Analysis API analyzes page content and provides suggestions for making nodes more search engine optimized. It adds a fieldset to the node edit forms with a targeted keyword phrase field and an “Analyze Content” button. When clicked the, the module sends your body, title and other content to the sever via AJAX and returns recommendations on how to better optimize each of your content areas. Statistics are also returned for each area, including character count, word count, keyword count, keyword density and keyword prominence. The statistics and recommendations are embedded via JavaScript underneath the node input fields for easy editing.

INSTALLATION
---------------
- Upload the Optimizer lysis directory to a modules directory on your server such as sites/all/modules or sites/default/modules.
- Enable the module via the admin > site building > modules
- Edit any existing node or add a node and you will see a new fieldset called "Content optimizer". Add a keyword phrase you want to target for the node and click the "Analize Content" button. After a few moments, a Content Optimizer recommendations boxes will be added to node edit form.
- To change any settings go to Site configuration > Content optimizer

CREDITS
----------------------------
Authored and maintained by Tom McCracken <tom AT leveltendesign DOT com> twitter: @levelten_tom
Sponsored by LevelTen Interactive - http://www.leveltendesign.com