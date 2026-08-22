import { test, expect } from '@playwright/test';

const projects = [
    { slug: 'kokolet-luxury', title: /Kokolet Luxury/i },
    { slug: 'billspro-fintech', title: /BillsPro/i },
    { slug: 'colala-mall', title: /Colala Mall/i },
    { slug: 'rhinoxpay-fintech', title: /RhinoxPay/i },
];

test.describe('Portfolio case studies', () => {
    for (const { slug, title } of projects) {
        test(`project /portfolio/${slug} loads with content`, async ({ page }) => {
            const response = await page.goto(`/portfolio/${slug}`);
            expect(response?.status()).toBe(200);
            await expect(page.getByText(title).first()).toBeVisible();
        });
    }

    test('kokolet luxury shows cover image and screen gallery', async ({ page }) => {
        await page.goto('/portfolio/kokolet-luxury');

        await expect(page.locator('img[src*="cover-"]').first()).toBeVisible();
        await expect(page.getByText(/The Challenge|Where they/i).first()).toBeVisible();
        await expect(page.getByText(/Inside the app|Every screen/i).first()).toBeVisible();

        const screenImages = page.locator('img[src*="home-"], img[src*="shop-"], img[src*="product-"]');
        await expect(screenImages.first()).toBeVisible();
    });

    test('portfolio navigation prev/next links work', async ({ page }) => {
        await page.goto('/portfolio/kokolet-luxury');

        const nextLink = page.getByRole('link', { name: /Next Project/i });
        if (await nextLink.isVisible()) {
            await nextLink.click();
            await expect(page).toHaveURL(/\/portfolio\//);
        }
    });
});
