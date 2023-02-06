<template>
  <q-layout view="hHh Lpr lFf">
    <q-page-container class="bg-grey-2">
      <!-- <div class="q-pa-sm"> -->
      <q-page
        padding
        class="row items-center justify-center"
        style="background: linear-gradient(#74c588, #0ad13c)"
      >
        <div class="row full-width">
          <div
            class="col-md-8 offset-md-2 col-xs-16 q-pl-md q-pr-md q-pt-sm q-mt-xl q-mr-sm"
          >
            <q-card flat class="bg-white text-black">
              <q-card-section class="bg-blue-14">
                <h4 class="text-h5 text-white q-my-md text-center">
                  {{ title }}
                </h4>
              </q-card-section>
              <div class="row">
                <div class="col-md-12 col-xs-12 q-pa-md">
                  <q-form
                    @submit="login()"
                    @reset="onReset"
                    class="q-gutter-md"
                  >
                    <div class="row">
                      <div class="col-md-12 col-xs-12 q-pa-md">
                        <q-input
                          color="white"
                          bg-color="blue-5"
                          standout
                          bottom-slots
                          v-model="employee.name"
                          label="ชื่อ-สกุล"
                          clearable
                        >
                          <template v-slot:prepend>
                            <q-icon name="person_add" />
                          </template>
                          <template v-slot:append>
                            <q-icon name="favorite" />
                          </template>
                        </q-input>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-input
                          color="white"
                          bg-color="blue-3"
                          standout
                          bottom-slots
                          v-model="employee.study_faculty"
                          label="ระบุสาขาวิชา"
                          clearable
                        >
                          <template v-slot:prepend>
                            <q-icon name="school" />
                          </template>
                          <template v-slot:append>
                            <q-icon name="favorite" />
                          </template>
                        </q-input>
                      </div>
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-select
                          color="blue-3"
                          v-model="employee.study_faculty"
                          :options="department.options"
                          label="เลือกสาขา"
                        >
                          <template v-slot:prepend>
                            <q-icon name="school" />
                          </template>
                        </q-select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-input
                          color="white"
                          bg-color="blue-3"
                          standout
                          bottom-slots
                          v-model="employee.university"
                          label="ระบุสถาบันการศึกษา"
                          clearable
                        >
                          <template v-slot:prepend>
                            <q-icon name="school" />
                          </template>
                          <template v-slot:append>
                            <q-icon name="favorite" />
                          </template>
                        </q-input>
                      </div>
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-select
                          color="blue-3"
                          v-model="employee.university"
                          :options="university.options"
                          label="เลือกสถาบันการศึกษา"
                        >
                          <template v-slot:prepend>
                            <q-icon name="school" />
                          </template>
                        </q-select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-input
                          color="white"
                          bg-color="blue-3"
                          standout
                          bottom-slots
                          v-model="employee.disability_type"
                          label="ระบุความบกพร่อง"
                          clearable
                        >
                          <template v-slot:prepend>
                            <q-icon name="assist_walker" />
                          </template>
                          <template v-slot:append>
                            <q-icon name="favorite" />
                          </template>
                        </q-input>
                      </div>
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-select
                          color="blue-3"
                          v-model="employee.disability_type"
                          :options="disability.options"
                          label="เลือกประเภทความพิการ"
                        >
                          <template v-slot:prepend>
                            <q-icon name="assist_walker" />
                          </template>
                        </q-select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12 q-pa-md">
                        <q-btn
                          label="บันทึก"
                          type="submit"
                          color="primary"
                          icon="save"
                        />
                        <q-btn
                          label="ยกเลิก"
                          type="reset"
                          color="primary"
                          flat
                          class="q-ml-sm"
                          icon="clear"
                        />
                      </div>
                    </div>
                  </q-form>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-xs-12 q-pa-md">
                  <!-- <div class="py-2">
    {{ employees_ }}
  </div>
  <div class="py-2">
    {{ employee }}
  </div> -->

                  <div class="q-pa-md">
                    <!-- <q-table
                      title="ข้อมูลส่วนตัว"
                      :rows="rows"
                      :columns="columns"
                      row-key="id"
                      v-model:pagination="pagination"
                      :loading="loading"
                      :filter="filter"
                      @request="onRequest"
                      binary-state-sort
                    >
                      <template v-slot:top-right>
                        <q-input
                          borderless
                          dense
                          debounce="300"
                          v-model="filter"
                          placeholder="Search"
                        >
                          <template v-slot:append>
                            <q-icon name="search" />
                          </template>
                        </q-input>
                      </template>
                    </q-table> -->
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">EP-ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Study Faculty</th>
                        <th scope="col">University</th>
                        <th scope="col">Disibility type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="row in employees" :key="row.index">
                        <td>{{ row.id }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.study_faculty }}</td>
                        <td>{{ row.university }}</td>
                        <td>{{ row.disability_type }}</td>
                        <td>
                          <button
                            class="btn btn-primary"
                            @click="editUser(row.id)"
                          >
                            Edit
                          </button>
                        </td>
                        <td>
                          <button
                            class="btn btn-warning"
                            @click="deleteUser(row.id)"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                      <tr></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </q-card>
          </div>
        </div>
      </q-page>
      <!-- </div> -->
    </q-page-container>
  </q-layout>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";
//EP-ID	Name	Study Faculty	University	Disibility type
const columns = [
  {
    name: "id",
    required: true,
    label: "รหัส",
    align: "left",
    field: (row) => row.id,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "name",
    align: "center",
    label: "ชื่อ-สกุล",
    field: (row) => row.name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "study_faculty",
    label: "สาขา",
    field: (row) => row.study_faculty,
    format: (val) => `${val}`,
  },
  {
    name: "university",
    label: "สถาบันการศึกษา",
    field: (row) => row.university,
    format: (val) => `${val}`,
  },
  {
    name: "disability_type",
    label: "ความพิการ",
    field: (row) => row.disability_type,
    format: (val) => `${val}`,
  },
];

export default {
  name: "LoginPage2",
  data() {
    return {
      title: "ข้อมูลส่วนตัว",
      email: "",
      username: "",
      password: "",
      repassword: "",
      register: false,
      passwordFieldType: "password",
      btnLabel: "กดปุ่ม",
      visibility: false,
      visibilityIcon: "visibility",
      input: {
        username: "",
        password: "",
      },
      member: {
        member_id: 0,
        full_name: "",
        status: "",
      },
      employees: Array,
      employees_: Array,
      university: {
        options: [
          "มหาวิทยาลัยเชียงใหม่",
          "มหาวิทยาลัยแม่โจ้",
          "มหาวิทยาลัยราชภัฏเชียงใหม่",
        ],
      },
      department: {
        options: [
          "การบริหารจัดการ",
          "การเงินและการจัดการ",
          "บริหารธุรกิจ",
          "วิทยาการคอมพิวเตอร์",
        ],
      },
      disability: {
        options: [
          "การเห็น",
          "การได้ยิน",
          "สติปัญญา",
          "ร่างกาย",
          "การเรียนรู้",
          "การพูด",
          "พฤติกรรม",
          "ออทิสติก",
          "พิการซ้ำซ้อน",
          "ปกติ",
        ],
      },
      employee: {
        id: this.$store.getters.myMember_id,
        name: this.$store.getters.myName,
        study_faculty: "",
        university: "",
        disability_type: "",
        isVisible: false,
      },
      isEdit: false,
      status: "บันทึก",
    };
  },

  methods: {
    login() {
      if (this.input.username != "" && this.input.password != "") {
        this.checkMember();
      } else {
        console.log("A username and password must be present");
      }
    },
    checkMember() {
      console.log(" ตรวจสอบข้อมูลสมาชิค ");
      var self = this;
      axios
        .post("http://localhost/ICPScoreCard/api-member.php", {
          action: "checkMember",
          user: this.input.username,
          pass: this.input.password,
        })
        .then(function (res) {
          self.member.member_id = res.data.map((item) => item.member_id)[0];
          self.member.full_name = res.data.map((item) => item.full_name)[0];
          self.member.status = res.data.map((item) => item.status)[0];
          self.storeCommit(
            self.member.member_id,
            self.member.full_name,
            self.member.status
          );
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeCommit(member_id, full_name, status) {
      console.log("login:", member_id);
      console.log("login:", full_name);
      console.log("login:", status);
      if (member_id != 0 && full_name != "" && status != "") {
        this.$store.commit("setMyAuthenticate", true);
        this.$store.commit("setMyMember_id", member_id);
        this.$store.commit("setMyName", full_name);
        this.$store.commit("setMyStatus", status);
        this.$router.replace({ name: "home" });
      } else {
        console.log("The username and / or password is incorrect");
      }
    },
    required(val) {
      return (val && val.length > 0) || "ช่องที่ต้องกรอก";
    },
    diffPassword(val) {
      const val2 = this.password;
      return (val && val === val2) || "รหัสผ่านไม่ตรงกัน!";
    },
    short(val) {
      return (val && val.length > 3) || "ค่าสั้นเกินไป";
    },
    isEmail(val) {
      const emailPattern =
        /^(?=[a-zA-Z0-9@._%+-]{6,254}$)[a-zA-Z0-9._%+-]{1,64}@(?:[a-zA-Z0-9-]{1,63}\.){1,8}[a-zA-Z]{2,63}$/;
      return emailPattern.test(val) || "กรุณาใส่อีเมลที่ถูกต้อง";
    },
    switchTypeForm() {
      this.register = !this.register;
      this.title = this.register ? "ผู้ใช้ใหม่" : "การอนุญาต";
      this.btnLabel = this.register ? "การลงทะเบียน" : "ทางเข้า";
    },
    switchVisibility() {
      this.visibility = !this.visibility;
      this.passwordFieldType = this.visibility ? "text" : "password";
      this.visibilityIcon = this.visibility ? "visibility_off" : "visibility";
    },
    onSubmit() {
      console.log("click submit");
    },
    onReset() {
      this.name = null;
      this.password = null;
    },
    resetForm() {
      this.status = "บันทึก";
      this.isEdit = false;
      console.log("ยกเลิกการบันทึกข้อมูล");
      // this.employee.id = 0;
      // this.employee.name = "";
      this.employee.study_faculty = "";
      this.employee.university = "";
      this.employee.disability_type = "";
      this.employee.isVisible = false;
    },
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("http://localhost/ICPScoreCard/api.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log(res);
          self.employees = res.data;
          // self.setup(self.employees);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    submitForm() {
      if (!this.isEdit) {
        console.log("บันทึกข้อมูล");
        console.log("Form employee:", this.employee);
        const newEmployee = {
          id: this.employee.id,
          name: this.employee.name,
          study_faculty: this.employee.study_faculty,
          university: this.employee.university,
          disibility_type: this.employee.disability_type,
          isVisible: this.employee.isVisible,
        };
        this.$emit("saveData", newEmployee);

        axios
          .post("http://localhost/ICPScoreCard/api.php", {
            action: "insert",
            id: this.employee.id,
            name: this.employee.name,
            study_faculty: this.employee.study_faculty,
            university: this.employee.university,
            disibility_type: this.employee.disability_type,
          })
          .then((res) => {
            console.log(res);
            this.resetForm();
            this.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      } else {
        axios
          .post("http://localhost/ICPScoreCard/api.php", {
            action: "update",
            id: this.employee.id,
            name: this.employee.name,
            study_faculty: this.employee.study_faculty,
            university: this.employee.university,
            disability_type: this.employee.disability_type,
          })
          .then((response) => {
            console.log(response);
            this.resetForm();
            this.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    editUser(id) {
      this.status = "Update(อัพเดท)";
      this.isEdit = true;
      var self = this;
      axios
        .post("http://localhost/ICPScoreCard/api.php", {
          action: "edit",
          id: id,
        })
        .then(function (response) {
          console.log(response);
          self.employee.id = response.data.id;
          self.employee.name = response.data.name;
          self.employee.study_faculty = response.data.study_faculty;
          self.employee.university = response.data.university;
          self.employee.disability_type = response.data.disability_type;
          self.employees_ = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(id) {
      if (confirm("คุณต้องการลบรหัส " + id + " หรือไม่ ?")) {
        var self = this;
        axios
          .post("http://localhost/ICPScoreCard/api.php", {
            action: "delete",
            id: id,
          })
          .then(function (response) {
            console.log(response);
            self.resetForm();
            self.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    setup(employees) {
      const rows = ref([]);
      const filter = ref("");
      const loading = ref(false);
      const pagination = ref({
        sortBy: "desc",
        descending: false,
        page: 1,
        rowsPerPage: 3,
        rowsNumber: 10,
      });
      var emps = employees;
      // emulate ajax call
      // SELECT * FROM ... WHERE...LIMIT...
      function fetchFromServer(startRow, count, filter, sortBy, descending) {
        var self = this;
        console.log("fetchFromServer:", emps);
        const data = filter
          ? emps.filter((row) => row.name.includes(filter))
          : emps.slice();

        // handle sortBy
        if (sortBy) {
          const sortFn =
            sortBy === "desc"
              ? descending
                ? (a, b) => (a.name > b.name ? -1 : a.name < b.name ? 1 : 0)
                : (a, b) => (a.name > b.name ? 1 : a.name < b.name ? -1 : 0)
              : descending
              ? (a, b) => parseFloat(b[sortBy]) - parseFloat(a[sortBy])
              : (a, b) => parseFloat(a[sortBy]) - parseFloat(b[sortBy]);
          data.sort(sortFn);
        }

        return data.slice(startRow, startRow + count);
      }

      // emulate 'SELECT count(*) FROM ...WHERE...'
      function getRowsNumberCount(filter) {
        console.log("employees", emps);
        if (!filter) {
          return emps.length;
        }
        let count = 0;
        emps.forEach((treat) => {
          if (treat.name.includes(filter)) {
            ++count;
          }
        });
        return count;
      }

      function onRequest(props) {
        const { page, rowsPerPage, sortBy, descending } = props.pagination;
        const filter = props.filter;

        loading.value = true;

        // emulate server
        setTimeout(() => {
          // update rowsCount with appropriate value
          pagination.value.rowsNumber = getRowsNumberCount(filter);

          // get all rows if "All" (0) is selected
          const fetchCount =
            rowsPerPage === 0 ? pagination.value.rowsNumber : rowsPerPage;

          // calculate starting row of data
          const startRow = (page - 1) * rowsPerPage;

          // fetch data from "server"
          const returnedData = fetchFromServer(
            startRow,
            fetchCount,
            filter,
            sortBy,
            descending
          );

          // clear out existing data and add new
          rows.value.splice(0, rows.value.length, ...returnedData);

          // don't forget to update local pagination object
          pagination.value.page = page;
          pagination.value.rowsPerPage = rowsPerPage;
          pagination.value.sortBy = sortBy;
          pagination.value.descending = descending;

          // ...and turn of loading indicator
          loading.value = false;
        }, 1500);
      }

      onMounted(() => {
        onRequest({
          pagination: pagination.value,
          filter: undefined,
        });
      });

      return {
        filter,
        loading,
        pagination,
        columns,
        rows,
        onRequest,
      };
    },
  },
  //chart
  created() {
    this.getAllUser();
  },
};
</script>
