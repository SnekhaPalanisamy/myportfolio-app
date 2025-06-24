import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Certifications } from './certifications';

describe('Certifications', () => {
  let component: Certifications;
  let fixture: ComponentFixture<Certifications>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [Certifications]
    })
    .compileComponents();

    fixture = TestBed.createComponent(Certifications);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
