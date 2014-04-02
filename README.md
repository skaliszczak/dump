dump
====

Debug tools - dump.php

Installation Symfony2

1. Copy to /web/dump.php
2. Require in app_dev.php
	require_once 'dump.php';
	
Documentation:

```php

dump($varible);				// shows varible like print_r but with pre tags
dumpv($varible);			// shows varible like var_dump but with pre tags
dumpt($varible);			// shows varible like print_r
dumph($varible);			// shows varible like print_r but with pre tags and use htmlspecialchars to show entities
dumpf($varible);			// shows varible like print_r into file dump.log
dump_date($timestamp);		// shows date from unix timestamp
dump_stack();				// shows current call stack

dump($varible, 'my name');	// shows varible like print_r but with pre tags and name
dump_off();					// disable dumping
dump_on();					// enable dumping
```

