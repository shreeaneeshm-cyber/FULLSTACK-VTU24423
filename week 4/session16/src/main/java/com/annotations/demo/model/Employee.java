package com.annotations.demo.model;

import org.springframework.stereotype.Component;

@Component   // Used in Session 19 (IoC)
public class Employee {

    private int id;
    private String name;
    private String department;

    // Default constructor (Session 19)
    public Employee() {
        this.id = 101;
        this.name = "John";
        this.department = "CSE";
    }

    // Parameterized constructor (Session 20)
    public Employee(int id, String name, String department) {
        this.id = id;
        this.name = name;
        this.department = department;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getDepartment() {
        return department;
    }
}