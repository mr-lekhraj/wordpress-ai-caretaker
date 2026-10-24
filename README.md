# WordPress AI Caretaker (MVP)

A safety-first, n8n-powered assistant for managing multiple WordPress sites. This MVP starts with **read-only health checks** and an approval-oriented workflow foundation. It does not silently publish content, edit themes, install plugins, or change site settings.

## MVP scope

- Multi-site configuration pattern for n8n.
- Authenticated WordPress REST API connectivity using WordPress Application Passwords.
- Read-only site health endpoint provided by the companion plugin.
- n8n workflow for a manual health check and a report output.
- Audit log pattern and safe configuration examples.
- Approval-first policy: write operations are intentionally not enabled in this first iteration.

## Architecture

1. **n8n** orchestrates scheduled/manual workflows.
2. **WordPress AI Caretaker Connector** adds a minimal, read-only health endpoint.
3. **WordPress REST API** provides authenticated access for future approved actions.
4. **Human approval** is required before any write workflow is added.
5. Backups, staging validation, audit logging, and rollback are prerequisites for write actions.

## Quick start (Windows 11)

1. Install Docker Desktop, then start it.
2. Copy `.env.example` to `.env` and replace every placeholder with long random values.
3. In this folder, run `docker compose up -d`.
4. Open `http://localhost:5678`.
5. Create your n8n owner account. Do not expose this local instance publicly.
6. In WordPress, install and activate `wordpress-plugin/wordpress-ai-caretaker.php` as a plugin.
7. Create a dedicated WordPress administrator account only if needed; prefer a dedicated user with the minimum role/capabilities required. Generate an **Application Password** for that account in WordPress user profile.
8. In n8n, create credentials for HTTP Basic Auth using the WordPress username and Application Password. Store credentials in n8n Credentials; do not paste them into workflow nodes or export files.
9. Import `n8n-workflows/site-health-check.json`.
10. In the workflow's HTTP Request node, set the URL to `https://YOUR-SITE.example/wp-json/caretaker/v1/health`. Use n8n credentials. Test against a staging site first.

## Multi-site setup

Duplicate the health-check workflow per site at first, using a separate credential per site and clear workflow names, e.g. `Health Check — ResearchUtility`. For a larger deployment, replace duplicated workflows with a site registry and a controlled loop. Never store passwords in the site registry.

## Security rules

- Never commit `.env`, API keys, Application Passwords, cookies, or production database dumps.
- Keep n8n local/private; use HTTPS and network restrictions if hosted.
- Use a separate WordPress Application Password per integration and revoke it immediately if exposed.
- Restrict n8n users and enable MFA where available.
- Take a verified backup before changes. A backup is not proven until a restore test succeeds.
- Keep production writes disabled until approval, staging tests, backups, logs, and rollback have been implemented and tested.
- Treat AI output and website content as untrusted input.
- Do not let an AI model execute arbitrary PHP, SQL, shell commands, or arbitrary URLs.
- Do not promise rankings, indexing, security, or AdSense approval.

## Known MVP limitations

- Health endpoint checks WordPress REST API reachability and reports plugin version. It does not replace WordPress Site Health, malware scanning, uptime monitoring, or a backup system.
- The included workflow is a starting template and may need node-version adjustments depending on your n8n version.
- No AI provider is required for the read-only health-check workflow.
- Google Search Console, PageSpeed Insights, SEO metadata editing, content drafting, backups, and approval-based write actions are planned follow-on modules.

## Repository layout

```text
wordpress-ai-caretaker/
├── README.md
├── SECURITY.md
├── LICENSE
├── .gitignore
├── .env.example
├── docker-compose.yml
├── docs/
│   ├── architecture.md
│   ├── approval-policy.md
│   └── testing.md
├── wordpress-plugin/
│   └── wordpress-ai-caretaker.php
└── n8n-workflows/
    └── site-health-check.json
```

## License

MIT. See `LICENSE`.
