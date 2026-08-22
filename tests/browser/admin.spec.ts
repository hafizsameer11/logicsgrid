import { test, expect } from '@playwright/test';
import { saveFilamentForm } from './helpers/auth';
import { loadTestData } from './helpers/test-data';

test.describe('Admin panel', () => {
    test.use({ storageState: { cookies: [], origins: [] } });

    test('login page loads', async ({ page }) => {
        await page.goto('/admin/login');
        await expect(page.getByRole('heading', { name: 'Sign in' })).toBeVisible();
        await expect(page.getByLabel('Email address')).toBeVisible();
        await expect(page.locator('#form\\.password')).toBeVisible();
    });

    test('guest cannot access dashboard', async ({ page }) => {
        await page.goto('/admin');
        await expect(page).toHaveURL(/\/admin\/login/);
    });
});

test.describe('Admin panel (authenticated)', () => {
    test('admin can reach dashboard', async ({ page }) => {
        await page.goto('/admin');
        await expect(page).toHaveURL(/\/admin/);
    });

    test('admin can access all CMS resource pages', async ({ page }) => {
        const resources = [
            '/admin/site-settings',
            '/admin/pages',
            '/admin/services',
            '/admin/projects',
            '/admin/team-members',
            '/admin/testimonials',
            '/admin/industries',
            '/admin/process-steps',
            '/admin/why-reasons',
            '/admin/problem-cards',
            '/admin/stats',
            '/admin/marquee-items',
            '/admin/social-links',
            '/admin/job-listings',
        ];

        for (const path of resources) {
            const response = await page.goto(path);
            expect(response?.status(), `Failed: ${path}`).toBe(200);
            await expect(page.locator('body')).not.toBeEmpty();
        }
    });

    test('admin can open project edit form', async ({ page }) => {
        await page.goto('/admin/projects');
        await page.getByRole('link', { name: /Edit/i }).first().click();
        await expect(page).toHaveURL(/\/admin\/projects\/\d+\/edit/);
        await expect(page.locator('[id*="title"]').first()).toBeVisible();
    });
});
