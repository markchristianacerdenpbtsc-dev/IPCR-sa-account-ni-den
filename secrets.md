# 🔐 API Keys & Credentials

⚠️ **IMPORTANT:** This file contains sensitive credentials. Never commit this to public repositories!

---

## ☁️ Cloudinary API (Photo Storage)

Add these to your `.env` file for cloud-based image storage:

```env
CLOUDINARY_CLOUD_NAME=dntjrz3mi
CLOUDINARY_API_KEY=666187645511746
CLOUDINARY_API_SECRET=0b0aCaMlUAvBoiBU_5srXLVD16o
CLOUDINARY_URL=cloudinary://666187645511746:0b0aCaMlUAvBoiBU_5srXLVD16o@dntjrz3mi
```

**Account Details:**
- Dashboard: https://cloudinary.com/console
- Cloud Name: `dntjrz3mi`
- API Key: `666187645511746`
- API Secret: `0b0aCaMlUAvBoiBU_5srXLVD16o`

---

## 🗄️ Database Configuration

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ipcr_system_v4
DB_USERNAME=root
DB_PASSWORD=
```

**For Production:**
- Update `DB_PASSWORD` with a strong password
- Consider using environment-specific database names

---

## 📧 Mail Service (Optional)

If you plan to send emails (password resets, notifications):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="noreply@ipcr.system"
MAIL_FROM_NAME="IPCR System"
```

**Recommended Services:**
- [Mailtrap](https://mailtrap.io) - For testing emails
- [SendGrid](https://sendgrid.com) - For production
- [Mailgun](https://mailgun.com) - Alternative option

---

## 🔑 Application Key

Generate a unique application key (automatically done via `php artisan key:generate`):

```env
APP_KEY=base64:generated_key_will_appear_here
```

---

## 🌐 GitHub Repository Links

- **Main Repository:** https://github.com/jarlokenpaghubasan/IPCR.git
- **Backup Repository:** https://github.com/markchristianacerdenpbtsc-dev/IPCR-sa-account-ni-den.git

---

## 👤 Default Admin Credentials

After running `php artisan db:seed`:

```
Username: admin
Password: password
Email: admin@ipcr.system
Employee ID: URS26-ADM00001
```

⚠️ **Change the password immediately in production!**

---

## 📝 Notes

- All credentials should be kept in `.env` file (already in `.gitignore`)
- Never share API secrets publicly
- Use different credentials for development and production
- Rotate API keys periodically for security

---

**Last Updated:** February 4, 2026
