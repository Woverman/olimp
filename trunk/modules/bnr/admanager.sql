# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Jan 28, 2003 at 01:38 PM
# Server version: 4.00.06
# PHP Version: 4.3.0
# Database : `admanager`
# --------------------------------------------------------

#
# Table structure for table `adman_banners`
#

CREATE TABLE adman_banners (
  id int(11) NOT NULL auto_increment,
  link varchar(50) default NULL,
  image varchar(50) default NULL,
  alt varchar(255) default NULL,
  status int(11) NOT NULL default '1',
  PRIMARY KEY  (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `adman_stats`
#

CREATE TABLE adman_stats (
  id int(11) NOT NULL default '0',
  amdate date NOT NULL default '0000-00-00',
  displays int(11) NOT NULL default '0',
  clicks int(11) NOT NULL default '0'
) TYPE=MyISAM;

