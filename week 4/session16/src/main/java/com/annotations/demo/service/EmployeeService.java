package com.annotations.demo.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.annotations.demo.model.Employee;

@Service
public class EmployeeService {

    @Autowired
    private Employee employee;

    public String getEmployeeDetails() {
        return "Employee ID: " + employee.getId() +
               "<br>Employee Name: " + employee.getName();
    }
}