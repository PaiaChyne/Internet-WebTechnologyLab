<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Registration</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page">

        <div class="form-card">

            <!-- Header -->
            <div class="form-header">
                <h1>Employee Registration</h1>
                <p>Enter the employee details below</p>
            </div>


            <form action="insert.php" method="POST">

                <!-- Personal Information -->

                <div class="section">

                    <h2>Personal Information</h2>

                    <div class="form-group">
                        <label for="name">Employee Name</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter full name"
                            required
                        >
                    </div>


                    <div class="form-row">

                        <div class="form-group">
                            <label for="email">Email Address</label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="example@email.com"
                                required
                            >
                        </div>


                        <div class="form-group">
                            <label for="phone">Phone Number</label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder="Enter phone number"
                                required
                            >
                        </div>

                    </div>

                </div>


                <!-- Employment Information -->

                <div class="section">

                    <h2>Employment Information</h2>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="department">
                                Department
                            </label>

                            <select
                                id="department"
                                name="department"
                                required
                            >

                                <option value="">
                                    Select department
                                </option>

                                <option value="IT">
                                    IT
                                </option>

                                <option value="HR">
                                    Human Resources
                                </option>

                                <option value="Finance">
                                    Finance
                                </option>

                                <option value="Marketing">
                                    Marketing
                                </option>

                                <option value="Sales">
                                    Sales
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label for="designation">
                                Designation
                            </label>

                            <input
                                type="text"
                                id="designation"
                                name="designation"
                                placeholder="e.g. Software Developer"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="salary">
                                Salary
                            </label>

                            <input
                                type="number"
                                id="salary"
                                name="salary"
                                placeholder="Enter salary"
                                step="0.01"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="joining_date">
                                Joining Date
                            </label>

                            <input
                                type="date"
                                id="joining_date"
                                name="joining_date"
                                required
                            >

                        </div>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="buttons">

                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        Add Employee
                    </button>


                    <a
                        href="view.php"
                        class="records-btn"
                    >
                        View Employee Records
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>