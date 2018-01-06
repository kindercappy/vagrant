# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "ubuntu/xenial64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  config.vm.network "forwarded_port", guest: 80, host: 80

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder "html", "/var/www/html", owner: "www-data", group: "www-data", mount_options: ["dmode=755,fmode=644"]

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
    vb.memory = "4096"
  end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Define a Vagrant Push strategy for pushing to Atlas. Other push strategies
  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define "atlas" do |push|
  #   push.app = "YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME"
  # end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
  
	# Exit on error
	set -e
	# Push in to the webroot
	pushd /var/www/html
	
	# Declare Variables
	DBHOST=localhost
	DBNAME=wordpress
	DBUSER=wordpress
	DBPASSWD=wordpress
	FILE=wordpress-4.8.3.tar.gz
	PROJECTS=( ajax )
	
	# Update ubuntu repository
	apt-get update
	
	# Install nginx and php with flag
	if [ ! -f .npinstalled ]
	then
    apt-get install -y nginx php php-fpm php-mysql php-curl php-xml php-gd git debconf-utils
	if [ $? -eq 0 ]
	then
	touch .npinstalled
	fi
	fi
	
	# Set MySQL credentials
	debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
	debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"
	
	# Install MySQL and enable multisite configuration with flag
	if [ ! -f .wpmsinstalled ]
	then
	apt-get install mysql-server -y
	# Create database and grant privileges
	mysql -uroot -p$DBPASSWD -e "CREATE DATABASE IF NOT EXISTS $DBNAME"
	mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'%' identified by '$DBPASSWD'"
	# Enable multisite configuration
	mysql -u root -p$DBPASSWD wordpress < vagrant_configuration/wordpress.sql
	if [ $? -eq 0 ]
	then
	touch .wpmsinstalled
	fi
	fi
	
	# Download and extract WordPress with flag
	if [ -f $FILE ]
	then
	echo "Archive exists! Skipping download"
	else
	wget https://wordpress.org/$FILE
	fi
	if [ ! -f .wpunarchived ]
	then
	tar -xzf $FILE --strip 1 --exclude='wordpress/wp-content/plugins'
	mkdir -p wp-content/temp
	if [ $? -eq 0 ]
	then
	touch .wpunarchived
	fi
	fi
	
	# Clone GIT repositories
	for i in "${PROJECTS[@]}"
	do
	if [ ! -f ."$i"cloned ]
	then
	git clone "https://github.com/kindercappy/wp-$i" wp-content/themes/$i
	if [ $? -eq 0 ]
	then
	touch ."$i"cloned
	fi
	fi
	done
	
	
	# Copy multisite configurations
	yes | cp -pvr vagrant_configuration/wp-config.php .
	#Copy MySQL configurations
	yes | cp -pvr vagrant_configuration/mysqld.cnf /etc/mysql/mysql.conf.d/
	#Restarting MySQL
	service mysql restart
	#Copy php configurations
	yes | cp -pvr vagrant_configuration/php.ini /etc/php/7.0/fpm/
	#Restarting PHP FPM
	service php7.0-fpm restart
	# Copy Nginx configurations
	yes | cp -pvr vagrant_configuration/nginx.conf /etc/nginx/
	yes | cp -pvr vagrant_configuration/default /etc/nginx/sites-available/
	# Restarting Nginx
	service nginx restart
	
	# Configure wp-config.php
	sed -i s/DATABASE_NAME/$DBNAME/g wp-config.php
	sed -i s/DATABASE_USERNAME/$DBUSER/g wp-config.php
	sed -i s/DATABASE_PASSWORD/$DBPASSWD/g wp-config.php
	sed -i s/DATABASE_HOSTNAME/$DBHOST/g wp-config.php
	
	#Pop out of the webroot
	popd
  SHELL
  end
