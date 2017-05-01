import { TestBed, inject } from '@angular/core/testing';

import { UserRepository } from './user-repository.service';

describe('UserRepositoryService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [UserRepository]
    });
  });

  it('should ...', inject([UserRepository], (service: UserRepository) => {
    expect(service).toBeTruthy();
  }));
});
