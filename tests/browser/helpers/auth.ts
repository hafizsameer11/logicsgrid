import type { Page } from '@playwright/test';

export const ADMIN_EMAIL = 'admin@logicsgrid.com';
export const ADMIN_PASSWORD = 'password';

export async function loginAsAdmin(page: Page): Promise<void> {
    await page.goto('/admin/login');
    await page.getByLabel('Email address').fill(ADMIN_EMAIL);
    await page.locator('#form\\.password').fill(ADMIN_PASSWORD);
    await page.getByRole('button', { name: 'Sign in' }).click();
    await page.waitForURL(/\/admin(?!\/login)/, { timeout: 30_000 });
}

export async function saveFilamentForm(page: Page): Promise<void> {
    const saveButton = page.getByRole('button', { name: /^Save changes$|^Save$/i }).first();
    await saveButton.click();
    await page.waitForLoadState('networkidle');
}
