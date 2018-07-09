<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>
    <div class="container">
        <div class="py-4 text-center">
            <?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('layouts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php if(Session::get('birthday')): ?>
        <div class="jumbotron align-items-center justify-content-center text-center py-4">
            <h1 class="display-3">Exchange Rate Result </h1>
            <p class="lead">The exchange rate in your last birthday (<?php echo \Carbon\Carbon::parse(Session::get('birthday'))->format('jS F Y'); ?>) was <span class="font-weight-bold"><?php echo e(Session::get('currency')); ?><?php echo number_format(Session::get('rate'), 2); ?></span></p>
            <p><a class="btn btn-lg btn-success" href="/" role="button">Try Again</a></p>
        </div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Birthday</th>
                    <th>Currency</th>
                    <th>Rate</th>
                    <th>Last Check</th>
                    <th>Number of Checks</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $exchangerates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exchangerate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($exchangerate['id']); ?></td>
                    <td><?php echo \Carbon\Carbon::parse($exchangerate['birthday'])->format('jS F Y'); ?></td>
                    <td><?php echo e($exchangerate['currency']); ?></td>
                    <td><?php echo e($exchangerate['rate']); ?></td>
                    <td><?php echo \Carbon\Carbon::parse($exchangerate['created_at'])->format('jS F Y'); ?></td>
                    <td><?php echo e($exchangerate['timeschecked']); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>