package edu.jfs.app;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class MVCController {

    @GetMapping("/")
    public String getMyPage(Model model) {
        model.addAttribute("str", "Nishanth");
        return "OneString";
    }

    @GetMapping("/person")
    public String getMyPersonData(Model model) {
        Person person = new Person(24506, "Nishanth");
        model.addAttribute("str", person.getNameString());
        return "OneString";
    }

    @GetMapping("/page")
    public String page() {
        return "index";
    }

    @GetMapping("/show")
    public String show(Model model) {
        Person person = new Person(24506, "Nishanth G");
        model.addAttribute("person", person);
        return "Person";
    }
}