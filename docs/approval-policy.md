# Approval policy

## Default: approval required

No workflow should publish content or modify a live site's design, settings, plugins, themes, or SEO fields without explicit approval.

A future proposed change should include:
- site hostname and object ID;
- before/after diff;
- reason and expected outcome;
- backup reference and restore instructions;
- staging test results;
- risk level;
- approver identity and timestamp;
- expiration time for the approval.

## Low-risk actions that may later be automated

Read-only audits, health checks, report generation, and notifications.

## Actions requiring approval

Publishing or updating pages/posts, changing metadata, modifying menus/design, enabling plugins, changing redirects, or altering site settings.

## Actions that should not be autonomous

Deleting content, disabling security plugins, changing administrator accounts, editing PHP, running SQL, changing DNS, or making irreversible changes.
