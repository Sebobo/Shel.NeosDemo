# Neosdemo for testing Neos and running surf deployments

## Starting

Run
   
    vagrant up
    
Edit your `/etc/hosts` file and add:

    # Neosdemo
    172.17.28.137 dev.neosdemo
    172.17.28.138 staging.neosdemo    
    
## Setup each box

### Dev

    vagrant ssh dev
    
#### Installation

Append your public key to the vagrant user in `/home/vagrant/.ssh/authorized_keys`.

Now you can login via:
   
    ssh -A vagrant@dev.neosdemo
    
#### Developing

Open this folder in PHPStorm and setup automatic deployment to the dev box like in the screenshots:

![Deployment Config](Documentation/DeploymentScreen.png "Deployment Config")
![Mapping Config](Documentation/MappingScreen.png "Mapping Config")
![Excluded Paths Config](Documentation/ExcludedPathsScreen.png "Excluded Paths Config")

Now right click on the project and run `Deployment -> Upload to neosbox` for the first time.
In `Tools` -> `Deployment` enable `Automatic Upload` and in the options `Upload external changes`.

Now your ready to go and can open your neos site for the first time by opening http://dev.neosdemo/ in your browser.

* Go through the wizard. The install tool pw will be created and you have to check it in `/var/www/Data/SetupPassword.txt`. 
* If the wizard asks you for the db credentials enter `root` as username and password and select the database `neos`.
* Enter your information when asked to create a new admin user.
* Import the neosdemo example content
* Login into the backend
* Done!
    
### Staging 
    
    vagrant ssh staging
    
#### Installation

Append your public key to the vagrant user in `/home/vagrant/.ssh/authorized_keys`.

Now you can login via:
   
    ssh -A vagrant@dev.neosdemo
    
Modify the vhost in `/usr/local/etc/nginx/common-neos.conf`:
    
* Change `root /var/www/Web/` to `root /var/www/releases/current/Web`.
* Add after `fastcgi_param  FLOW_REWRITEURLS  1;` the line `fastcgi_param FLOW_CONTEXT Production;`.
* Restart nginx via `sudo service nginx restart`.
* Change vagrant users shell to bash via `sudo chsh -s /usr/local/bin/bash vagrant`.
    
## Deploying

Run

    ./surf.phar deploy staging

After it finished go to http://staging.neosdemo and run the wizard like before.

Done!

## Setup gitlab

TODO
