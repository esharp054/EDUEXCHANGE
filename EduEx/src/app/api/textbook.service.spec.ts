import { TestBed, inject } from '@angular/core/testing';

import { TextbookService } from './textbook.service';

describe('TextbookService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [TextbookService]
    });
  });

  it('should ...', inject([TextbookService], (service: TextbookService) => {
    expect(service).toBeTruthy();
  }));
});
