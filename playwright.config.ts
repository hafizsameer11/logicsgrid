import { defineConfig, devices } from '@playwright/test';

const PORT = process.env.BROWSER_TEST_PORT ?? '8001';
const BASE_URL = `http://127.0.0.1:${PORT}`;

export default defineConfig({
    testDir: './tests/browser',
    fullyParallel: false,
    forbidOnly: !!process.env.CI,
    retries: process.env.CI ? 2 : 0,
    workers: 1,
    reporter: [['list'], ['html', { open: 'never' }]],
    timeout: 60_000,
    use: {
        baseURL: BASE_URL,
        trace: 'on-first-retry',
        screenshot: 'only-on-failure',
        video: 'retain-on-failure',
    },
    projects: [
        {
            name: 'setup',
            testMatch: /auth\.setup\.ts/,
        },
        {
            name: 'chromium',
            dependencies: ['setup'],
            use: {
                ...devices['Desktop Chrome'],
                storageState: 'tests/browser/.auth/admin.json',
            },
        },
    ],
    globalSetup: './tests/browser/global-setup.ts',
    webServer: {
        command: `DB_CONNECTION=sqlite DB_DATABASE=database/browser-test.sqlite php artisan serve --port=${PORT}`,
        url: `${BASE_URL}/up`,
        reuseExistingServer: !process.env.CI,
        timeout: 180_000,
    },
});
