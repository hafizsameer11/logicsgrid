import { test, expect } from '@playwright/test';

const pages = [
    { path: '/about', text: /About|LogicsGrid|Builders/i },
    { path: '/team', text: /Team|ship the work/i },
    { path: '/contact', text: /Contact|hi@logicsgrid/i },
    { path: '/portfolio', text: /Portfolio|work/i },
    { path: '/why-logicsgrid', text: /Why LogicsGrid|LogicsGrid/i },
    { path: '/industries', text: /Industries|industry/i },
    { path: '/privacy', text: /Privacy/i },
    { path: '/terms', text: /Terms/i },
];

const services = [
    '/software-development',
    '/startup-growth',
    '/ai-solutions',
    '/venture-building',
    '/business-digitization',
];

test.describe('Frontend pages', () => {
    for (const { path, text } of pages) {
        test(`page ${path} loads`, async ({ page }) => {
            const response = await page.goto(path);
            expect(response?.status()).toBe(200);
            await expect(page.getByText(text).first()).toBeVisible();
        });
    }

    for (const path of services) {
        test(`service ${path} loads`, async ({ page }) => {
            const response = await page.goto(path);
            expect(response?.status()).toBe(200);
            await expect(page.locator('body')).not.toBeEmpty();
        });
    }
});
