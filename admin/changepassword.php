<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="dboard background mt-2 float-end w-[82%]">
            <div class="box text-white h-[410px]">
                <h2 class="background font-semibold text-xl py-2 px-3">Change Password</h2>
                <div class="block p-5">               
                    <form>
                        <table class="form w-full">					
                            <tr>
                                <td>
                                    <label class="font-semibold">Old Password</label>
                                </td>
                                <td>
                                    <input type="password" placeholder="Enter Old Password..."  name="title" style="width: 60%;" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="font-semibold">New Password</label>
                                </td>
                                <td>
                                    <input type="password" placeholder="Enter New Password..." name="slogan" style="width: 60%;" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                                <td class="pt-3">
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php include 'inc/footer.php'; ?>