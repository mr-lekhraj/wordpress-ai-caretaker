# Testing checklist

## Local setup
- [ ] `.env` created locally and excluded from Git.
- [ ] A unique `N8N_ENCRYPTION_KEY` configured and backed up securely.
- [ ] n8n binds to localhost only.
- [ ] n8n owner account configured.

## WordPress connector
- [ ] Plugin activates without PHP warnings.
- [ ] Anonymous request to the health endpoint returns 401/403.
- [ ] Authorized administrator request returns JSON with `status: ok`.
- [ ] A user without `manage_options` cannot read the endpoint.
- [ ] No credentials appear in logs or response payloads.

## Workflow
- [ ] Import JSON successfully into your installed n8n version.
- [ ] Add credentials through n8n's Credentials UI.
- [ ] Test with staging first.
- [ ] Verify the report contains no secrets.
- [ ] Verify failed requests produce a visible failure, not a false green status.

## Before any future write workflow
- [ ] Backup exists and restore has been tested.
- [ ] Approval is required and expires.
- [ ] Input schema and site allowlist are enforced.
- [ ] Staging test passes.
- [ ] Audit log is written.
- [ ] Rollback is tested.
