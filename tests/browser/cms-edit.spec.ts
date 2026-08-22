import { test, expect } from '@playwright/test';
import { saveFilamentForm } from './helpers/auth';
import { loadTestData } from './helpers/test-data';

test.describe('CMS content adjustability via browser', () => {
    test.describe.configure({ mode: 'serial' });

    test('admin edits project title and it appears on frontend', async ({ page }) => {
        const { kokoletProjectId } = loadTestData();
        const uniqueTitle = `Browser Test Project ${Date.now()}`;

        await page.goto(`/admin/projects/${kokoletProjectId}/edit`);

        const titleField = page.locator('input[id*="title"]').first();
        await titleField.clear();
        await titleField.fill(uniqueTitle);

        await saveFilamentForm(page);

        await page.goto('/portfolio/kokolet-luxury');
        await expect(page.getByText(uniqueTitle).first()).toBeVisible({ timeout: 15_000 });
    });

    test('admin edits site setting hero title and it appears on homepage', async ({ page }) => {
        const { heroTitleSettingId } = loadTestData();
        const uniqueHero = `Browser Hero ${Date.now()}`;

        await page.goto(`/admin/site-settings/${heroTitleSettingId}/edit`);

        const valueField = page.locator('textarea[id*="value"], input[id*="value"]').first();
        await valueField.clear();
        await valueField.fill(uniqueHero);

        await saveFilamentForm(page);

        await page.goto('/');
        await expect(page.getByRole('heading', { level: 1 })).toContainText(uniqueHero, { timeout: 15_000 });
    });

    test('admin edits team member name and it appears on homepage', async ({ page }) => {
        const { homeTeamMemberId } = loadTestData();
        const uniqueName = `BrowserTeam${Date.now()}`;

        await page.goto(`/admin/team-members/${homeTeamMemberId}/edit`);

        const nameField = page.locator('input[id*="name"]').first();
        await nameField.clear();
        await nameField.fill(uniqueName);

        await saveFilamentForm(page);

        await page.goto('/');
        await expect(page.getByText(uniqueName).first()).toBeVisible({ timeout: 15_000 });
    });
});

test.describe('Image adjustability via browser', () => {
    test('homepage hero image is rendered and loads', async ({ page }) => {
        await page.goto('/');

        const img = page.locator('section img').first();
        await expect(img).toBeVisible();

        const src = await img.getAttribute('src');
        expect(src).toBeTruthy();

        const response = await page.request.get(src!);
        expect(response.status()).toBe(200);
    });

    test('portfolio cover image loads successfully', async ({ page }) => {
        await page.goto('/portfolio/kokolet-luxury');

        const cover = page.locator('img[src*="cover-"]').first();
        await expect(cover).toBeVisible();

        const src = await cover.getAttribute('src');
        const response = await page.request.get(src!);
        expect(response.status()).toBe(200);
    });

    test('team member photos load on homepage', async ({ page }) => {
        await page.goto('/');

        const teamImg = page.locator('img[src*="peter-"], img[src*="juliana-"], img[src*="sameer-"], img[src*="blaise-"]').first();
        await expect(teamImg).toBeVisible();

        const src = await teamImg.getAttribute('src');
        const response = await page.request.get(src!);
        expect(response.status()).toBe(200);
    });

    test('service card images load on homepage', async ({ page }) => {
        await page.goto('/');

        const serviceImg = page.locator('img[src*="pillar-"], img[src*="ai-hero"], img[src*="vb-hero"]').first();
        await expect(serviceImg).toBeVisible();

        const src = await serviceImg.getAttribute('src');
        const response = await page.request.get(src!);
        expect(response.status()).toBe(200);
    });

    test('admin project edit form shows cover image field', async ({ page }) => {
        await page.goto('/admin/projects');
        await page.getByRole('link', { name: /Edit/i }).first().click();

        await expect(page.locator('[id*="cover_image"], [id*="cover-image"]').first()).toBeVisible();
    });
});
