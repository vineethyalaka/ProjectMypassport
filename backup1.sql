mysqldump  Ver 8.21 Distrib 3.23.49, for sun-solaris2.8 (sparc)
By Igor Romanenko, Monty, Jani & Sinisa
This software comes with ABSOLUTELY NO WARRANTY. This is free software,
and you are welcome to modify and redistribute it under the GPL license

Dumping definition and data mysql database or table
Usage: mysqldump [OPTIONS] database [tables]
OR     mysqldump [OPTIONS] --databases [OPTIONS] DB1 [DB2 DB3...]
OR     mysqldump [OPTIONS] --all-databases [OPTIONS]

  -A, --all-databases   Dump all the databases. This will be same as
		        --databases with all databases selected.
  -a, --all		Include all MySQL specific create options.
  -#, --debug=...       Output debug log. Often this is 'd:t:o,filename`.
  --character-sets-dir=...
                        Directory where character sets are
  -?, --help		Display this help message and exit.
  -B, --databases       To dump several databases. Note the difference in
			usage; In this case no tables are given. All name
			arguments are regarded as databasenames.
			'USE db_name;' will be included in the output
  -c, --complete-insert Use complete insert statements.
  -C, --compress        Use compression in server/client protocol.
  --default-character-set=...
                        Set the default character set
  -e, --extended-insert Allows utilization of the new, much faster
                        INSERT syntax.
  --add-drop-table	Add a 'drop table' before each create.
  --add-locks		Add locks around insert statements.
  --allow-keywords	Allow creation of column names that are keywords.
  --delayed-insert      Insert rows with INSERT DELAYED.
  --master-data         This will cause the master position and filename to 
                        be appended to your output. This will automagically 
                        enable --first-slave.
  -F, --flush-logs	Flush logs file in server before starting dump.
  -f, --force		Continue even if we get an sql-error.
  -h, --host=...	Connect to host.
  -l, --lock-tables     Lock all tables for read.
  --no-autocommit       Wrap tables with autocommit/commit statements.
  -K, --disable-keys   '/*!40000 ALTER TABLE tb_name DISABLE KEYS */;
                        and '/*!40000 ALTER TABLE tb_name ENABLE KEYS */;
                        will be put in the output.
  -n, --no-create-db    'CREATE DATABASE /*!32312 IF NOT EXISTS*/ db_name;'
                        will not be put in the output. The above line will
                        be added otherwise, if --databases or
                        --all-databases option was given.
  -t, --no-create-info	Don't write table creation info.
  -d, --no-data		No row information.
  -O, --set-variable var=option
                        give a variable a value. --help lists variables
  --opt			Same as --add-drop-table --add-locks --all --quick
                        --extended-insert --lock-tables --disable-keys
  -p, --password[=...]	Password to use when connecting to server.
                        If password is not given it's solicited on the tty.

  -P, --port=...	Port number to use for connection.
  -q, --quick		Don't buffer query, dump directly to stdout.
  -Q, --quote-names	Quote table and column names with `
  -r, --result-file=... Direct output to a given file. This option should be
                        used in MSDOS, because it prevents new line '\n'
                        from being converted to '\n\r' (newline + carriage
                        return).
  -S, --socket=...	Socket file to use for connection.
  --tables              Overrides option --databases (-B).
  -T, --tab=...         Creates tab separated textfile for each table to
                        given path. (creates .sql and .txt files).
                        NOTE: This only works if mysqldump is run on
                              the same machine as the mysqld daemon.
  -u, --user=#		User for login if not current user.
  -v, --verbose		Print info about the various stages.
  -V, --version		Output version information and exit.
  -w, --where=		dump only selected records; QUOTES mandatory!
  -X, --xml             dump a database as well formed XML
  -x, --first-slave     Locks all tables across all databases.
  EXAMPLES: "--where=user='jimf'" "-wuserid>1" "-wuserid<1"
  Use -T (--tab=...) with --fields-...
  --fields-terminated-by=...
                        Fields in the textfile are terminated by ...
  --fields-enclosed-by=...
                        Fields in the importfile are enclosed by ...
  --fields-optionally-enclosed-by=...
                        Fields in the i.file are opt. enclosed by ...
  --fields-escaped-by=...
                        Fields in the i.file are escaped by ...
  --lines-terminated-by=...
                        Lines in the i.file are terminated by ...

Default options are read from the following files in the given order:
/etc/my.cnf /usr/local/mysql/var/my.cnf ~/.my.cnf 
The following groups are read: mysqldump client
The following options may be given as the first argument:
--print-defaults	Print the program argument list and exit
--no-defaults		Don't read default options from any options file
--defaults-file=#	Only read default options from the given file #
--defaults-extra-file=# Read this file after the global files are read

Possible variables for option --set-variable (-O) are:
max_allowed_packet    current value: 25165824
net_buffer_length     current value: 1047551
