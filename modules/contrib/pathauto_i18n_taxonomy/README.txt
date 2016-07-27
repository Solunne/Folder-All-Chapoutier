What does this module do?
--------------------------
This Module adds an optional "BULK UPDATE" operation to the pathauto module.
Here: admin/config/search/path/update_bulk called "Taxonomy term paths for i18n"


Token support
--------------------------
Uses basic token support from i18n and adds support for [term:i18n-parents:*] chained tokens.


Tested and used
---------------------------------------------------------------------------------
Tested with [term:i18n-vocabulary]/[term:i18n-parents:join-path]/[term:i18n-name]

Why?
--------------
You can generate taxonomy paths in the translated language so that the user gets the path in his language

Example:

www.url.com/de/hund/alt
www.url.com/en/dog/old
www.url.com/fr/chien/agee

