import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const testDataPath = path.join(path.dirname(fileURLToPath(import.meta.url)), '..', 'test-data.json');

export type BrowserTestData = {
    heroTitleSettingId: number;
    homeTeamMemberId: number;
    kokoletProjectId: number;
};

export function loadTestData(): BrowserTestData {
    return JSON.parse(fs.readFileSync(testDataPath, 'utf8')) as BrowserTestData;
}
