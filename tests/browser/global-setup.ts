import { execSync } from 'node:child_process';
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '../..');
const testDataPath = path.join(root, 'tests/browser/test-data.json');

function artisan(expression: string): string {
    return execSync(
        `DB_CONNECTION=sqlite DB_DATABASE=database/browser-test.sqlite php artisan tinker --execute="${expression}"`,
        { cwd: root, encoding: 'utf8' },
    ).trim();
}

export default async function globalSetup(): Promise<void> {
    const setupScript = path.join(root, 'scripts/browser-test-setup.sh');
    execSync(`bash "${setupScript}"`, { stdio: 'inherit', cwd: root });

    const heroTitleSettingId = artisan(
        "echo \\App\\Models\\SiteSetting::where('group','hero')->where('key','title_line1')->value('id');",
    );
    const homeTeamMemberId = artisan(
        "echo \\App\\Models\\TeamMember::where('section','home')->orderBy('sort_order')->value('id');",
    );
    const kokoletProjectId = artisan(
        "echo \\App\\Models\\Project::where('slug','kokolet-luxury')->value('id');",
    );

    fs.writeFileSync(
        testDataPath,
        JSON.stringify({
            heroTitleSettingId: Number(heroTitleSettingId),
            homeTeamMemberId: Number(homeTeamMemberId),
            kokoletProjectId: Number(kokoletProjectId),
        }),
        'utf8',
    );
}
