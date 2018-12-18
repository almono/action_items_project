To run the project:

If composer is installed on the machine all that has to be done is just running few commands from the console inside project directory.
While inside the project directory first command to run is "composer install" which should install all needed vendors for the project to work.

Next command is "php artisan migrate" which will prepare the table for the action records. And the last command is "php artisan db:seed".

The seed is used to fill the actions table with data from json file. Functionality of reading json file is still done, I just thought this might be a bit faster way
to prepare the project for checking. ( the form for uploading json is on the welcome blade but it is just hidden with html at the moment )
HomePageController contains all the methods used in this project ( uploading json file, uploading image for the task, updating action and downloading file ).
The project uses 1 main blade that is used as the "master" blade and homepage blade containing all the tasks found in database with all the other operations 
that can be done. Decided to go with one view to increase the speed and comfort of using this project ( so the user doesn't have to go to another location/url just
to view the changes done to only one action ).

The project is also set up at http://actions.almono.pl in case you would like to check it live as well.

I am also working on another project ( completely for myself ) that uses CMS. I use it as a way to improve myself so it contains methods responsible for user permissions,
SEO optimalization and even Google Analytics. I still try to come up with ideas on what could be done to get closer to the perfection but thought it would be a 
nice idea to mention it.

The project can be found at: http://cms.almono.pl and the administration panel can be accessed via cms.almono.pl/admin . Guest email address is guest@almono.cms and the 
password is CMSGuest123.

Guest has permissions only to view certain areas so the functionality might not be visible so I also include bitbucket link so that might be easier to view
certain areas of this project: https://bitbucket.org/almonos/almono_cms/src/master/ 
