<template>
  <form class="col s12">
    <div class="row">
      <div class="input-field col s4">
        <input id="name" type="text" class="validate" />
        <label for="name">Name...</label>
      </div>
      <div class="input-field col s4">
        <input id="Study-Faculty" type="text" class="validate" />
        <label for="Study-Faculty">Study Faculty...</label>
      </div>
      <div class="input-field col s4">
        <input id="University" type="text" class="validate" />
        <label for="University">University...</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <input id="Disibility-type" type="text" class="validate" />
        <label for="Disibility-type">Disibility type...</label>
      </div>
      <div class="input-field col s4">
        <input id="Plan-Career" type="text" class="validate" />
        <label for="Plan-Career">Plan Career...</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <input id="Qualifications-need" type="text" class="validate" />
        <label for="Qualifications-need">Qualifications need...</label>
      </div>
      <div class="input-field col s4">
        <input id="Qualifications-Level" type="text" class="validate" />
        <label for="Qualifications-Level">Qualifications Level...</label>
      </div>
      <div class="input-field col s4">
        <input id="Qualifications-Goal" type="text" class="validate" />
        <label for="Qualifications-Goal">Qualifications goal...</label>
      </div>
      <div class="input-field col s4">
        <input id="Qualifications-need" type="text" class="validate" />
        <label for="Qualifications-need">Qualifications need...</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <input id="Month-assessment" type="text" class="validate" />
        <label for="Month-assessment">Month assessment...</label>
      </div>
      <div class="input-field col s4">
        <input id="Self-assessment" type="text" class="validate" />
        <label for="Self-assessment">Self assessment...</label>
      </div>
    </div>

    <div class="col s3">
      <div class="row">
        <a class="col s6 waves-effect waves-light bnt-large teal lighter-2">
          <i class="material-icons"> cloud_download </i>
        </a>
        <a class="col s6 waves-effect waves-light bnt-large pink lighter-2">
          <i class="material-icons"> cloud_upload </i>
        </a>
      </div>
    </div>
  </form>

  <div class="py-2">
    {{ employees }}
  </div>

  <div class="py-2">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Study Faculty</th>
          <th scope="col">University</th>
          <th scope="col">Disibility type</th>
          <th scope="col">Plan Career</th>
          <th scope="col">level</th>
          <th scope="col">goal</th>
          <th scope="col">doing</th>
          <th scope="col">learning</th>
          <th scope="col">month</th>
          <th scope="col">self assessment</th>
          <!-- <th scope="col">Salary</th> -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in employees" :key="row.index">
          <td>{{ row.id }}</td>
          <td>{{ row.name }}</td>
          <td>{{ row.study_faculty }}</td>
          <td>{{ row.university }}</td>
          <td>{{ row.disability_type }}</td>
          <td>{{ row.plan_career }}</td>
          <td>{{ row.level }}</td>
          <td>{{ row.goal }}</td>
          <td>{{ row.doing }}</td>
          <td>{{ row.leaning }}</td>
          <td>{{ row.month }}</td>
          <td>{{ row.assessment }}</td>
        </tr>
        <tr></tr>
      </tbody>
    </table>
  </div>
  <line-chart :data="{ '2017-05-13': 2, '2017-05-14': 5 }"></line-chart>
  <pie-chart
    :data="[
      ['Blueberry', 44],
      ['Strawberry', 23],
    ]"
  ></pie-chart>
  <column-chart
    :data="[
      ['Sun', 32],
      ['Mon', 46],
      ['Tue', 28],
    ]"
  ></column-chart>
  <bar-chart
    :data="[
      ['X-Small', 5],
      ['Small', 27],
    ]"
  ></bar-chart>
  <area-chart
    :data="{ '2017-01-01 00:00:00 -0800': 2, '2017-01-01 00:01:00 -0800': 5 }"
  ></area-chart>
  <scatter-chart
    :data="[
      [174.0, 80.0],
      [176.5, 82.3],
    ]"
    xtitle="Size"
    ytitle="Population"
  ></scatter-chart>
  <line-chart :data="data_" />
</template>

<script>
import axios from "axios";

export default {
  name: "FormDashborad",
  components: {},
  data() {
    return {
      message: "Form Dashborad",
      employees: Array,
      employees_: Array,
      data_: [
        {
          name: "Workout",
          data: {
            "2017-01-01 00:00:00 -0800": 3,
            "2017-01-02 00:00:00 -0800": 4,
          },
        },
        {
          name: "Call parents",
          data: {
            "2017-01-01 00:00:00 -0800": 5,
            "2017-01-02 00:00:00 -0800": 3,
          },
        },
      ],
      employee: {
        id: 1,
        name: "สมชาย วันชัย",
        study_faculty: "การบริหารจัดการ",
        university: "มหาวิทยาลัยแม่โจ้",
        disability_type: "สายตาเลือนลาง",
        plan_career: "นักบริหารการขายหรือการตลาด",
        salary: 15000,
      },
      planCareer: {
        Plan_Career_id: 1,
        Employee_id: 1,
        Name_Plan_Career: "นักบริหารจัดการ",
        Description: "การบริหารจัดการคือ การประสานงานและการบริหารหน้าที่ต่าง ๆ",
      },
      qualification: {
        qualificationId: 1,
        planCareerId: 1,
        level: "Must have",
        goal: "Yes",
      },
      selfAssessment: {
        selfAssessmentId: 1,
        qualificationId: 1,
        month: "มกราคม",
        assessment: "ํYes",
      },
      plan: {
        planId: 1,
        qualificationId: 1,
        doing: "หางาน part-time หาประสบการณ์ก่อนเรียนจบ (อย่างน้อย 2 งาน)",
        leaning: "เคยเรียนทักษะนี้มาบ้าง",
      },
      isEdit: false,
      status: "บันทึก",
    };
  },
  methods: {
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("http://localhost/ICPScoreCard/api-dashboard.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log(res);
          self.employees = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created() {
    this.getAllUser();
  },
};
</script>

<style></style>
