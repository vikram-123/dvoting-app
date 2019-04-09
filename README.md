# dvoting-app
GUI based decentralized voting application using blockchain

Requirements: php,mysql,node.js,ganache-cli

1. Download Materialize CSS files and paste them in project folder. (https://github.com/Dogfalo/materialize/releases/download/1.0.0/materialize-v1.0.0.zip)
2. Create application launcher script

    In a terminal run:

    mkdir -p bin  --This command will make a bin directory in your home folder if you don't already have it.

    After run:

    gedit ~/bin/open_app.sh  --This will create the new file open_app.sh in gedit.

    Copy and paste the following script in the new created file:

    #!/bin/bash

    if [[ "$1" != "app://" ]]; then 
        app=${1#app://}
        nohup "$app" &>/dev/null &
    else 
        nohup gnome-terminal &>/dev/null &
    fi

    Save the file and close it.

    Go back into terminal and run:

    chmod +x ~/bin/open_app.sh  --to grant execute access for the script.

3. Create .desktop file for application launcher

    (for Server)
    sudo -H gedit /usr/share/applications/appurl.desktop
    
    [Desktop Entry]
    Name=ServerTerminal
    Exec=gnome-terminal -x sh -c 'node_modules/.bin/ganache-cli; exec bash'
    Type=Application
    NoDisplay=true
    Categories=System;
    MimeType=x-scheme-handler/app;

    Save the file and close it.
    
    (for Client)
    sudo -H gedit /usr/share/applications/apurl.desktop
    
    [Desktop Entry]
    Name=ClientTerminal
    Exec=gnome-terminal -x sh -c 'cd /var/www/html/voting_app; node'
    Type=Application
    NoDisplay=true
    Categories=System;
    MimeType=x-scheme-handler/ap;
    
    Save the file and close it.
    
4. Refresh mime types database

In the file above, the line MimeType=x-scheme-handler/app; register app:// scheme handler, but to make it work we should update mime types database cache by executing command:

sudo update-desktop-database 

DATABASE
To create database execute the following command:

mysql --user=username --password=password votedb < votedb.sql
