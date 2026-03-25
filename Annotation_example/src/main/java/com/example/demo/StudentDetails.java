package com.example.demo;

import org.springframework.stereotype.Component;

@Component
public class StudentDetails {

    private final Course_Details courseDetails;

    public StudentDetails(Course_Details courseDetails) {
        this.courseDetails = courseDetails;
        System.out.println("StudentDetails bean created");
        showDetails();
    }

    public void showDetails() {
        System.out.println("Course: " + courseDetails.getCourseName());
    }
}
