# Instagram Feed Embed — Setup Guide

This guide explains how to connect SNEAKERS.ID to Instagram using the **Instagram API with Instagram Login**. The homepage shows the latest 12 posts in a responsive grid. Posts are cached for 1 hour.

---

## What you need before starting

| Requirement | Notes |
|---|---|
| Instagram account | Must be a **Business** or **Creator** account |
| Meta Developer account | https://developers.facebook.com |
| Admin access | To SNEAKERS.ID CMS and server `.env` |
| Public callback URL | Meta must be able to redirect to your site after login |

- **Important:** This integration uses **Instagram Login**, not ~~Facebook Login~~ and not ~~the oEmbed API~~. 
- In Meta Developer Console, choose the use case **Manage messaging & content on Instagram**. 
- Do **not** use ~~**Embed Facebook, Instagram and Threads content in other websites**~~ (oEmbed) — that is a different product and will not work with this app.

---

## Part 1 — Prepare the Instagram account

1. Open the Instagram app (or instagram.com).
2. Go to **Settings → Account type and tools**.
3. Switch to a **Business** or **Creator** account if you have not already.
4. Note the username you want to show on the homepage (for example `@aviabee.id`).

You do not need to link a Facebook Page for this flow. The app connects directly to the Instagram account you select during OAuth.

---

## Part 2 — Create a Meta app

1. Go to [Meta for Developers](https://developers.facebook.com).
2. Click **My Apps → Create App**.
3. Choose **Other** (or the option that lets you pick use cases manually).
4. Select app type **Business** when asked.
5. Enter an app name (for example `Sneakers Instagram Feed`) and contact email.
6. Click **Create app**.

---

## Part 3 — Choose the correct use case

1. In the app dashboard, open **Use cases** (or **Add use cases** during setup).
2. Find **Manage messaging & content on Instagram**.
3. **Check / add** this use case.

Expected OAuth scope used by SNEAKERS.ID:

```
instagram_business_basic
```

This scope allows reading the connected account profile and media (posts) for the homepage feed.

---

## Part 4 — Configure Instagram Login and get credentials

1. In the left sidebar, open **Instagram → API setup with Instagram login** (wording may vary slightly).
2. On that page, copy **Instagram App ID** and **Instagram App Secret** (Meta may label these as App ID / App Secret). Keep the secret private — never commit it to git.
3. Complete any other required setup steps shown on that page.
4. Find **OAuth redirect URIs** (sometimes under **Business login settings** or **Instagram login settings**).
5. Add your callback URL(s). They must match **exactly** — same protocol, domain, path, and no trailing slash unless you configured one.

**Production:**

```
https://sneakers.id/administrator/instagram/callback
```

**Development** (add only if you test locally):

```
https://development.sneakers.id/administrator/instagram/callback
```

6. Save changes.

Add the credentials from step 2 to `.env` as `INSTAGRAM_APP_ID` and `INSTAGRAM_APP_SECRET`.

---

## Part 5 — Add testers (Development mode)

While the app is in **Development** mode, only users with a role on the Meta app can complete OAuth.

1. Go to **App roles → Roles** (or **People → Test users / Testers**).
2. Add the Instagram/Facebook account that owns the Business account you want to connect as an **Admin**, **Developer**, or **Tester**.
3. That user must accept the invitation if prompted.

For a live store, switch the app to **Live** mode after Meta review (if required for your use case and permissions).

---

## Part 6 — Configure SNEAKERS.ID

### 6.1 Environment variables

Add the App ID and App Secret from **Part 4, step 2** to `.env`:

```env
APP_URL=https://sneakers.id

INSTAGRAM_APP_ID=your_meta_app_id
INSTAGRAM_APP_SECRET=your_meta_app_secret
INSTAGRAM_REDIRECT_URI="${APP_URL}/administrator/instagram/callback"

INSTAGRAM_GRAPH_VERSION=v21.0
INSTAGRAM_CACHE_TTL=3600
INSTAGRAM_POSTS_LIMIT=12
```

After changing `.env`, clear config cache on the server:

```bash
php artisan config:clear
```

### 6.2 Database migration

Run once on each environment:

```bash
php artisan migrate
```

This creates the `instagram_connections` table used to store the encrypted access token and account info.

---

## Part 7 — Connect Instagram in the admin CMS

1. Log in to the SNEAKERS.ID admin panel.
2. Open **Instagram** in the sidebar (`/administrator/instagram`).
3. Click **Connect with Instagram**.
4. Log in with the Instagram account you want to display.
5. When Meta asks **Choose the Instagram accounts you want [App Name] to access**, select your account (for example `aviabee.id`) and continue.
6. You should return to the admin page with a success message and a preview of recent posts.

---

## Part 8 — Verify the homepage

1. Visit the store homepage.
2. Scroll to the Instagram section.
3. You should see up to **12** recent posts in a grid.

If no account is connected, the section is hidden or empty.
