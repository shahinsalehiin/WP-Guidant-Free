# Testing the “Ask Review” logic

Use this to verify each part of the review notice (options, conditions, AJAX, UI).

---

## 1. Enable test mode (no waiting for dates)

In **wp-config.php** add before `/* That's all, stop editing! */`:

```php
define( 'GUIDANT_REVIEW_TEST', true );
```

Then you can:

- **Force show the notice on any admin page:**  
  `https://yoursite.com/wp-admin/?guidant_show_review=1`  
  (or append `&guidant_show_review=1` to any admin URL)

- **Reset state so the notice can show again:**  
  Visit:  
  `https://yoursite.com/wp-admin/?guidant_review_reset=1`  
  You will be redirected; then go to `?guidant_show_review=1` again to see the notice.

---

## 2. Test each piece of logic

### 2.1 Notice does **not** show when user can’t manage options

1. Log in as a user **without** `manage_options` (e.g. Editor).
2. With test mode on, visit:  
   `wp-admin/?guidant_show_review=1`
3. **Expect:** No review notice.
4. Log back in as Admin and repeat; notice should appear.

---

### 2.2 Notice does **not** show when “already reviewed”

1. With test mode on, open:  
   `wp-admin/?guidant_show_review=1`  
   Notice should be visible.
2. Click **“I already did”** (or **“Yes, you deserve it”**).
3. Notice should disappear (AJAX + fadeOut).
4. Reload the same URL or go to any admin page (with or without `guidant_show_review=1`).
5. **Expect:** Notice never shows again (option `guidant_already_reviewed` is set).
6. To test again: visit `wp-admin/?guidant_review_reset=1`, then `?guidant_show_review=1`.

---

### 2.3 “Yes, you deserve it”

1. Reset: `wp-admin/?guidant_review_reset=1`, then open `?guidant_show_review=1`.
2. Click **“Yes, you deserve it”**.
3. **Expect:**
   - New tab/window opens with the review URL (filtered by `guidant_review_url`).
   - Notice disappears.
   - Option `guidant_already_reviewed` is set (timestamp).
4. Reload admin; notice must not show.

---

### 2.4 “I already did”

1. Reset and show notice again.
2. Click **“I already did”** (no link, same as “Yes” for the backend).
3. **Expect:**
   - No new tab.
   - Notice disappears.
   - `guidant_already_reviewed` is set.
4. Reload admin; notice must not show.

---

### 2.5 “No, maybe later”

1. Reset and show notice again.
2. Click **“No, maybe later”**.
3. **Expect:**
   - Notice disappears (AJAX + fadeOut).
   - Option `guidant_review_notice_date` is **deleted**.
   - Option `guidant_review_notice_delayed` is set to `true`.
4. **Without** test mode: turn off `GUIDANT_REVIEW_TEST`, reload admin. Notice should **not** show yet (next show time is 14 days from now).
5. **With** test mode: `?guidant_show_review=1` still forces the notice (test mode ignores dates).

---

### 2.6 Dismiss (X) = “Maybe later”

1. Reset and show notice again.
2. Click the **dismiss (X)** on the notice.
3. **Expect:** Same as “No, maybe later”: notice disappears, `guidant_review_notice_date` deleted, `guidant_review_notice_delayed` set.

---

### 2.7 AJAX: already reviewed

1. Open DevTools → Network, filter by XHR/fetch.
2. Reset and show notice, then click **“I already did”**.
3. **Expect:** One request to `admin-ajax.php` with:
   - `action=guidant_already_reviewed`
   - `security=<nonce>`
   - Response: `{"success":true,"data":"success"}`.
4. In DB/options: `guidant_already_reviewed` = current timestamp.

---

### 2.8 AJAX: maybe later

1. Reset and show notice.
2. Click **“No, maybe later”** and watch Network.
3. **Expect:** Request with `action=guidant_review_maybe_later`, success response.
4. In DB: `guidant_review_notice_date` removed, `guidant_review_notice_delayed` = true.

---

### 2.9 Install date and first delay (without test mode)

1. In DB or with a small script, delete:
   - `guidant_install_date`
   - `guidant_review_notice_date`
   - `guidant_review_notice_delayed`
   - `guidant_already_reviewed`
2. Turn **off** test mode (remove or set `GUIDANT_REVIEW_TEST` to false).
3. Load any admin page once.
4. **Expect:**  
   - `guidant_install_date` is set (current time).  
   - `guidant_review_notice_date` is set to “now + 7–30 days” (random first time).
5. Notice should **not** show until that date has passed (or use test mode to force it).

---

### 2.10 After “maybe later”, next delay is 14 days

1. With test mode off, set options so the notice would show (e.g. set `guidant_review_notice_date` to a past timestamp), and ensure `guidant_review_notice_delayed` is false.
2. Load admin; notice shows. Click **“No, maybe later”**.
3. Check DB: `guidant_review_notice_date` is deleted, `guidant_review_notice_delayed` = true.
4. Reload admin: `get_review_notice_date()` will set a **new** `guidant_review_notice_date` = now + 14 days.
5. **Expect:** Notice does not show again until 14 days later (or force with test mode).

---

### 2.11 Review URL filter

In your theme or a small mu-plugin:

```php
add_filter( 'guidant_review_url', function( $url ) {
    return 'https://example.com/my-custom-review-page';
} );
```

Open notice and click **“Yes, you deserve it”**. **Expect:** The custom URL opens, not the default WordPress.org one.

---

## 3. Options reference

| Option                         | Set when                          | Effect |
|--------------------------------|-----------------------------------|--------|
| `guidant_install_date`       | First admin load (if missing)     | Used to compute when to show notice. |
| `guidant_review_notice_date` | First time or after “maybe later”| Notice allowed only when `current_time > this`. |
| `guidant_review_notice_delayed` | User clicked “Maybe later” or X | Next delay is fixed 14 days. |
| `guidant_already_reviewed`  | User clicked “Yes” or “I already did” | Notice never shown again. |

---

## 4. Turn off test mode for production

Remove or comment out in **wp-config.php**:

```php
// define( 'GUIDANT_REVIEW_TEST', true );
```

Query params `guidant_show_review` and `guidant_review_reset` have no effect when `GUIDANT_REVIEW_TEST` is not defined or is false.
