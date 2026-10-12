# SDPC Physiotherapy — Android APK Packaging & Distribution Guide

This guide explains how to package the **SDPC Laravel Progressive Web App (PWA)** into an installable **Android `.apk` file** that you can send directly to your client via WhatsApp, Google Drive, or Email.

---

## Important Concept: How a Laravel App Becomes an Android APK

Because Laravel runs on PHP, the Laravel application itself is hosted on an **HTTPS web server** (e.g., `https://sdpc.yourdomain.com`). The Android APK wraps your live HTTPS PWA using either:

1. **Method A: Capacitor Android Wrapper (Recommended for custom splash screen & offline shell)** — Pre-configured via [`capacitor.config.json`](file:///c:/Users/hp/Downloads/App/capacitor.config.json).
2. **Method B: Trusted Web Activity (TWA / Bubblewrap or PWABuilder)** — Pre-configured via [`twa-manifest.json`](file:///c:/Users/hp/Downloads/App/twa-manifest.json).

Both methods keep your Laravel PWA 100% functional in regular mobile/desktop browsers while producing a real native Android `.apk`.

---

## App Identification & Branding Summary

- **App Name:** `SDPC`
- **Package ID:** `com.sdpc.physiotherapy`
- **Doctor:** Dr. Mahesh Sahu (Physiotherapist, Indore)
- **Theme Color:** `#0B1B3A` (Primary Navy)
- **Splash Screen Background:** `#0B1B3A`
- **Launcher Icons:**
  - `public/assets/icons/icon-192x192.png`
  - `public/assets/icons/icon-512x512.png`
  - `public/assets/logo.png`

---

## Step 1: Deploy the Laravel App to an HTTPS Domain

Before building the production APK, deploy this Laravel folder to any PHP 8.1+ hosting with SSL (HTTPS):

1. Upload the project files to your server.
2. Point your domain document root to the `/public` directory.
3. In `.env`, set:
   ```env
   APP_NAME="SDPC"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-production-domain.com
   SDPC_ASSET_CDN_URL=
   ```
4. Verify that `https://your-production-domain.com/manifest.json` and `https://your-production-domain.com/service-worker.js` load over HTTPS.

---

## Step 2: Prerequisites on Your Build Machine

To compile a signed `.apk` locally, install:
1. **Node.js (v18+)** and **npm**
2. **Java JDK 17** (bundled with Android Studio)
3. **Android Studio** (with **Android SDK Platform 34**, **Android SDK Build-Tools**, and **Android SDK Command-line Tools**)
4. Set environment variable `ANDROID_HOME` to your Android SDK path:
   - Windows default: `C:\Users\<YourUser>\AppData\Local\Android\Sdk`

---

## Method A: Build Android APK Using Capacitor (Full Control)

### 1. Configure Production Domain
Open [`capacitor.config.json`](file:///c:/Users/hp/Downloads/App/capacitor.config.json) and replace `https://sdpc-indore.example.com` with your live HTTPS domain:

```json
{
  "appId": "com.sdpc.physiotherapy",
  "appName": "SDPC",
  "webDir": "public",
  "server": {
    "url": "https://your-production-domain.com",
    "cleartext": false,
    "allowNavigation": [
      "your-production-domain.com",
      "*.your-production-domain.com"
    ]
  }
}
```

### 2. Install Capacitor & Generate the Android Project
Run these commands in the project root (`c:\Users\hp\Downloads\App`):

```powershell
npm install
npx cap add android
npx cap sync android
```

### 3. Configure Launcher Icon & Splash Screen
Copy `public/assets/icons/icon-512x512.png` into Android Studio's **Image Asset Studio** (`Right-click app -> New -> Image Asset`) to automatically generate `mdpi`, `hdpi`, `xhdpi`, `xxhdpi`, and `xxxhdpi` adaptive launcher icons with background color `#0B1B3A`.

### 4. Generate a Signed Release Keystore
Run the following command once to create your signing key:

```powershell
keytool -genkey -v -keystore sdpc-release-key.keystore -alias sdpc-key-alias -keyalg RSA -keysize 2048 -validity 10000
```

### 5. Build the Signed Release APK
You can build via **Android Studio**:
1. Run `npx cap open android`
2. Go to **Build → Generate Signed Bundle / APK...**
3. Select **APK** → Choose `sdpc-release-key.keystore` → Enter password → Select **release** build variant.
4. Your APK will be generated at:
   `android/app/release/app-release.apk`

Or build directly from the **Command Line (Gradle)**:
```powershell
cd android
./gradlew assembleRelease
```

---

## Method B: Build Android APK Using Bubblewrap TWA (Fastest CLI / No Android Studio UI Needed)

1. Update `host`, `iconUrl`, and `webManifestUrl` in [`twa-manifest.json`](file:///c:/Users/hp/Downloads/App/twa-manifest.json) to match your live HTTPS URL.
2. Run:
   ```powershell
   npx @bubblewrap/cli build
   ```
3. Bubblewrap will output `app-release-signed.apk` ready to send to the client.

### Digital Asset Links (Removes Browser URL Bar in TWA)
To ensure the TWA runs in full-screen standalone mode without the Chrome address bar, create `public/.well-known/assetlinks.json` containing your keystore's SHA-256 fingerprint:
```json
[{
  "relation": ["delegate_permission/common.handle_all_urls"],
  "target": {
    "namespace": "android_app",
    "package_name": "com.sdpc.physiotherapy",
    "sha256_cert_fingerprints": ["YOUR_KEYSTORE_SHA256_FINGERPRINT_HERE"]
  }
}]
```

---

## Step 3: Testing the APK on an Android Phone

1. **Direct Send (WhatsApp / Drive):**
   - Rename `app-release-signed.apk` to `SDPC-Physiotherapy.apk`.
   - Send it to the client or your test Android phone on WhatsApp.
   - Tap the file on Android, allow *"Install from this source"* if prompted, and open **SDPC**.
2. **Via USB Debugging (ADB):**
   ```powershell
   adb install -r SDPC-Physiotherapy.apk
   ```
3. **Verify Features on Device:**
   - Check the launcher icon and splash screen (`#0B1B3A`).
   - Test bottom navigation tabs (Home, Videos, Categories, Doctor, Contact).
   - Test instant category/date video filters.
   - Tap **Call**, **WhatsApp**, **Directions**, and **Share Video**.
   - Turn on Airplane Mode to verify the **Offline Mode** indicator and cached pages.
