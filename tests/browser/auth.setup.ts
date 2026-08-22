import { test as setup, expect } from '@playwright/test';
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { ADMIN_EMAIL, ADMIN_PASSWORD } from './helpers/auth';

const authFile = path.join(path.dirname(fileURLToPath(import.meta.url)), '.auth/admin.json');

setup('authenticate admin', async ({ page }) => {
    fs.mkdirSync(path.dirname(authFile), { recursive: true });

    await page.goto('/admin/login');
    await page.getByLabel('Email address').fill(ADMIN_EMAIL);
    await page.locator('#form\\.password').fill(ADMIN_PASSWORD);
    await page.getByRole('button', { name: 'Sign in' }).click();
    await page.waitForURL(/\/admin(?!\/login)/, { timeout: 30_000 });
    await expect(page.getByText(/Dashboard|LogicsGrid CMS/i).first()).toBeVisible();

    await page.context().storageState({ path: authFile });
});
