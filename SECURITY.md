# Security Policy

## Reporting a vulnerability

Do not open a public issue containing secrets or exploit details. Contact the repository owner privately using GitHub's security advisory feature once enabled.

## Supported security posture

This MVP is read-only by design. Do not enable production write actions until:
- a tested backup and restore process exists;
- actions are allowlisted and schema-validated;
- human approval is recorded for each proposed mutation;
- requests are authenticated and replay-resistant;
- audit events capture actor, target, action, timestamp, and result without secrets;
- staging validation and rollback are tested.

Never publish secrets in issues, logs, screenshots, workflow exports, or commits.
