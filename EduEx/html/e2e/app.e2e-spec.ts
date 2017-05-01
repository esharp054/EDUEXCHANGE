import { EduExPage } from './app.po';

describe('edu-ex App', () => {
  let page: EduExPage;

  beforeEach(() => {
    page = new EduExPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
