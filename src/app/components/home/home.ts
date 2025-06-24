import { Component, OnInit } from '@angular/core';
import { trigger, style, animate, transition } from '@angular/animations';

@Component({
  selector: 'app-home',
  standalone: false,
  templateUrl: './home.html',
  styleUrl: './home.scss',
  animations: [
    trigger('fadeIn', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(20px)' }),
        animate('600ms ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
    ]),
  ],
})
export class Home implements OnInit {
 titles = ['.NET Developer', 'Azure Engineer', 'Full Stack Developer'];
  currentTitleIndex = 0;

  ngOnInit(): void {
    setInterval(() => {
      this.currentTitleIndex = (this.currentTitleIndex + 1) % this.titles.length;
      this.updateTitleActiveClass();
    }, 3000);
  }

  updateTitleActiveClass() {
    const titlesElements = document.querySelectorAll('.animated-titles .title');
    titlesElements.forEach((el, i) => {
      if (i === this.currentTitleIndex) {
        el.classList.add('active');
      } else {
        el.classList.remove('active');
      }
    });
  }
}
