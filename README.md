# at.greenpeace.droptrigger

This extension allows the removal of database triggers set by CiviCRM,
using the `hook_civicrm_triggerInfo` hook. 

> **WARNING**: The extension is currently hardcoded to remove the `civicrm_activity_before_update` trigger.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.6+
* CiviCRM 5.7+

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl at.greenpeace.droptrigger@https://github.com/greenpeace-cee/at.greenpeace.droptrigger/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/greenpeace-cee/at.greenpeace.droptrigger.git
cv en droptrigger
```

## Usage

1. Install the extension
2. Visit http://example.com/civicrm/menu/rebuild?reset=1&triggerRebuild=1 to rebuild triggers
3. Unwanted triggers will be removed

## Known Issues

* The list of triggers to be removed is currently hardcoded in `droptrigger_civicrm_triggerInfo`.
  This should be moved to a setting.
