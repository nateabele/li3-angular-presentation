# easy installation of Apache modules
define apache::loadmodule () {
  exec { "/usr/sbin/a2enmod $name" :
    unless => "/bin/readlink -e /etc/apache2/mods-enabled/${name}.load",
    notify => Service['apache2']
  }
}


# this makes puppet and vagrant shut up about the puppet group
group { "puppet": 
  ensure => "present", 
}

# make sure the packages are up to date before beginning
exec { "apt-get update":
  command => "/usr/bin/apt-get update",
}
# sudo apt-get -y install git-core gitosis

# because puppet command are not run sequentially, ensure that packages are
# up to date before installing before installing packages, services, files, etc.
Package { require => Exec["apt-get update"] }
File { require => Exec["apt-get update"] }

# ensure packages are installed to create a LAMP environment
package { "vim":
  ensure => present,
}
package { "apache2":
  ensure => present,
}
package { "php5-dev":
  ensure => present,
}
package { "php-pear":
  ensure => present,
}
package { "php5-xdebug":
  ensure => present,
}
package { "php5-mcrypt":
  ensure => present,
}
package { "mongodb":
  ensure => present,
}

exec {"/usr/bin/pecl install mongo":
  require => Package['php5-dev']
}
exec {"/usr/bin/sudo ln -sf /etc/php5/apache2/php.ini /etc/php5/cli/php.ini":
  require => Package['php5-dev']
}
exec {"/bin/rm /etc/php5/cli/conf.d/mcrypt.ini":
  require => Package['php5-mcrypt']
}
apache::loadmodule{"rewrite": }

# starts the apache2 service once the packages installed, and monitors changes
# to its configuration files and reloads if necessary
service { "apache2":
  ensure => running,
  enable => true,
  require => [Package['apache2'], File["/etc/php5/apache2/php.ini"]],
  subscribe => [File["/etc/apache2/mods-enabled/rewrite.load"], File["/etc/apache2/sites-available/default"]],
}

# ensures that mod_rewrite is loaded and modifies the default configuration file
file { "/etc/apache2/mods-enabled/rewrite.load":
  ensure => link,
  target => "/etc/apache2/mods-available/rewrite.load",
  require => Package['apache2'],
}
file { "/etc/apache2/sites-available/default":
  ensure => present,
  source => "/vagrant/_build/manifests/default.conf",
}
file { "/etc/php5/apache2/php.ini":
  ensure => present,
  require => [Package['apache2'], Package['php5-dev']],
  source => "/vagrant/_build/manifests/php.ini",
}
