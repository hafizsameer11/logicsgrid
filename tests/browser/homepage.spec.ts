import { test, expect } from '@playwright/test';

test.describe('Homepage', () => {
    test('loads hero section with dynamic content', async ({ page }) => {
        await page.goto('/');

        await expect(page).toHaveTitle(/LogicsGrid/i);
        await expect(page.getByRole('heading', { level: 1 })).toContainText(/Build, scale|operate/i);
        await expect(page.locator('section').first()).toBeVisible();
    });

    test('displays hero image from CMS', async ({ page }) => {
        await page.goto('/');

        const heroImage = page.locator('img[src*="hero-cinematic"]').first();
        await expect(heroImage).toBeVisible();
        await expect(heroImage).toHaveAttribute('src', /hero-cinematic/);
    });

    test('shows services, team, and featured work sections', async ({ page }) => {
        await page.goto('/');

        await expect(page.getByText(/Software Development/i).first()).toBeVisible();
        await expect(page.getByText(/Featured Work|Recent things/i).first()).toBeVisible();
        await expect(page.getByText(/The Team|Leaders/i).first()).toBeVisible();
    });

    test('marquee ticker is visible', async ({ page }) => {
        await page.goto('/');

        await expect(page.locator('#marquee-track')).toBeVisible();
        await expect(page.getByText(/Founded in 2016/i).first()).toBeVisible();
    });

    test('navigation links work', async ({ page }) => {
        await page.goto('/');

        await page.getByRole('link', { name: /Contact/i }).first().click();
        await expect(page).toHaveURL(/\/contact/);
    });
});
