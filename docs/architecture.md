# Architecture

## First iteration

- n8n is the workflow engine.
- WordPress AI Caretaker Connector exposes `GET /wp-json/caretaker/v1/health`.
- The endpoint is read-only and requires a logged-in WordPress user with `manage_options`.
- n8n calls the endpoint using WordPress Application Password authentication.
- The workflow produces a compact health report.

## Multi-site model

Use one credential per WordPress site. Label credentials and workflows with the site's hostname. Do not put credentials in node parameters, environment-independent JSON exports, or AI prompts.

## Future modules

1. Site registry with explicit allowed hostnames.
2. Read-only SEO audit (metadata, headings, canonical, robots, sitemap, broken internal links).
3. AI content draft creation only, stored as `draft`.
4. Explicit approval node/action with reviewer identity and expiry.
5. Backup verification and staging checks before a write.
6. Change execution through a narrow allowlist of WordPress REST operations.
7. Post-change smoke test; automatic rollback or disablement if checks fail.

## Threat model notes

- Website posts, pages, plugin names, and remote HTML are untrusted content.
- Avoid arbitrary URL fetches to prevent SSRF. Allowlist connected site origins.
- Do not grant the model direct access to shell, database, or arbitrary code execution.
