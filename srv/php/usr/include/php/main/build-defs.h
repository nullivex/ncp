/*                                                                -*- C -*-
   +----------------------------------------------------------------------+
   | PHP Version 5                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2007 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Author: Stig Sæther Bakken <ssb@php.net>                             |
   +----------------------------------------------------------------------+
*/

/* $Id: build-defs.h.in 292156 2009-12-15 11:17:47Z jani $ */

#define CONFIGURE_COMMAND " './configure'  '--prefix=/opt/ncp/srv/php' '--exec-prefix=/opt/ncp/srv/php' '--bindir=/opt/ncp/srv/php/bin' '--sbindir=/opt/ncp/srv/php/sbin' '--sysconfdir=/opt/ncp/srv/php/etc' '--datadir=/opt/ncp/srv/php/usr/share' '--includedir=/opt/ncp/srv/php/usr/include' '--libdir=/opt/ncp/srv/php/lib64' '--libexecdir=/opt/ncp/srv/php/libexec' '--localstatedir=/opt/ncp/srv/php/var' '--sharedstatedir=/opt/ncp/srv/php/com' '--mandir=/opt/ncp/srv/php/share/man' '--infodir=/opt/ncp/srv/php/share/info' '--with-libdir=lib64' '--with-config-file-path=/opt/ncp/srv/etc' '--with-config-file-scan-dir=/opt/ncp/srv/etc/php.d' '--disable-debug' '--with-pic' '--disable-rpath' '--without-pear' '--with-bz2' '--with-curl' '--with-exec-dir=/opt/ncp/srv/php/bin' '--with-freetype-dir=/usr' '--with-png-dir=/usr' '--with-gd' '--enable-gd-native-ttf' '--without-gdbm' '--with-gettext' '--with-gmp' '--with-iconv' '--with-jpeg-dir=/usr' '--with-openssl' '--with-png-dir=/usr' '--with-pspell' '--with-libexpat-dir=/usr' '--with-pcre-regex=/usr' '--with-zlib' '--with-layout=GNU' '--enable-exif' '--enable-ftp' '--enable-magic-quotes' '--enable-sockets' '--enable-sysvsem' '--enable-sysvshm' '--enable-sysvmsg' '--enable-wddx' '--with-kerberos' '--enable-shmop' '--enable-calendar' '--with-libxml-dir=/usr' '--enable-xml' '--with-xpm-dir=/usr' '--with-mysql=mysqlnd' '--with-pdo-mysql=mysqlnd' '--enable-zip' '--with-ldap' '--with-ldap-sasl' '--with-mcrypt' '--with-mhash' '--enable-mbstring' '--enable-cgi' '--enable-soap'"
#define PHP_ADA_INCLUDE		""
#define PHP_ADA_LFLAGS		""
#define PHP_ADA_LIBS		""
#define PHP_APACHE_INCLUDE	""
#define PHP_APACHE_TARGET	""
#define PHP_FHTTPD_INCLUDE      ""
#define PHP_FHTTPD_LIB          ""
#define PHP_FHTTPD_TARGET       ""
#define PHP_CFLAGS		"$(CFLAGS_CLEAN) -prefer-non-pic -static"
#define PHP_DBASE_LIB		""
#define PHP_BUILD_DEBUG		""
#define PHP_GDBM_INCLUDE	""
#define PHP_IBASE_INCLUDE	""
#define PHP_IBASE_LFLAGS	""
#define PHP_IBASE_LIBS		""
#define PHP_IFX_INCLUDE		""
#define PHP_IFX_LFLAGS		""
#define PHP_IFX_LIBS		""
#define PHP_INSTALL_IT		"@echo "Installing PHP CGI binary: $(INSTALL_ROOT)$(bindir)/"; $(INSTALL) -m 0755 $(SAPI_CGI_PATH) $(INSTALL_ROOT)$(bindir)/$(program_prefix)php-cgi$(program_suffix)$(EXEEXT)"
#define PHP_IODBC_INCLUDE	""
#define PHP_IODBC_LFLAGS	""
#define PHP_IODBC_LIBS		""
#define PHP_MSQL_INCLUDE	""
#define PHP_MSQL_LFLAGS		""
#define PHP_MSQL_LIBS		""
#define PHP_MYSQL_INCLUDE	""
#define PHP_MYSQL_LIBS		""
#define PHP_MYSQL_TYPE		""
#define PHP_ODBC_INCLUDE	""
#define PHP_ODBC_LFLAGS		""
#define PHP_ODBC_LIBS		""
#define PHP_ODBC_TYPE		""
#define PHP_OCI8_SHARED_LIBADD 	""
#define PHP_OCI8_DIR			""
#define PHP_OCI8_ORACLE_VERSION		""
#define PHP_ORACLE_SHARED_LIBADD 	"@ORACLE_SHARED_LIBADD@"
#define PHP_ORACLE_DIR				"@ORACLE_DIR@"
#define PHP_ORACLE_VERSION			"@ORACLE_VERSION@"
#define PHP_PGSQL_INCLUDE	""
#define PHP_PGSQL_LFLAGS	""
#define PHP_PGSQL_LIBS		""
#define PHP_PROG_SENDMAIL	""
#define PHP_SOLID_INCLUDE	""
#define PHP_SOLID_LIBS		""
#define PHP_EMPRESS_INCLUDE	""
#define PHP_EMPRESS_LIBS	""
#define PHP_SYBASE_INCLUDE	""
#define PHP_SYBASE_LFLAGS	""
#define PHP_SYBASE_LIBS		""
#define PHP_DBM_TYPE		""
#define PHP_DBM_LIB		""
#define PHP_LDAP_LFLAGS		""
#define PHP_LDAP_INCLUDE	""
#define PHP_LDAP_LIBS		""
#define PHP_BIRDSTEP_INCLUDE     ""
#define PHP_BIRDSTEP_LIBS        ""
#define PEAR_INSTALLDIR         ""
#define PHP_INCLUDE_PATH	".:"
#define PHP_EXTENSION_DIR       "/opt/ncp/srv/php/lib64/20090626"
#define PHP_PREFIX              "/opt/ncp/srv/php"
#define PHP_BINDIR              "/opt/ncp/srv/php/bin"
#define PHP_SBINDIR             "/opt/ncp/srv/php/sbin"
#define PHP_LIBDIR              "/opt/ncp/srv/php/lib64"
#define PHP_DATADIR             "/opt/ncp/srv/php/usr/share"
#define PHP_SYSCONFDIR          "/opt/ncp/srv/php/etc"
#define PHP_LOCALSTATEDIR       "/opt/ncp/srv/php/var"
#define PHP_CONFIG_FILE_PATH    "/opt/ncp/srv/etc"
#define PHP_CONFIG_FILE_SCAN_DIR    "/opt/ncp/srv/etc/php.d"
#define PHP_SHLIB_SUFFIX        "so"
